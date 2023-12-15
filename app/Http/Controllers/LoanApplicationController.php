<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use App\Traits\EmailTrait;
use App\Traits\FileTrait;
use App\Traits\LoanTrait;
use App\Traits\UserTrait;
use App\Traits\WalletTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoanApplicationController extends Controller
{     
    use EmailTrait, LoanTrait, UserTrait, WalletTrait, FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function alreadyLoaned($id){
        $check = Application::where('status', 0)->where('complete', 0)
        ->where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('livewire.already-have-loan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoan(Request $req)
    {
        $email = $req->toArray()['email']; 
        $application = User::where('email', $email)->get()->toArray();  
        // $application = Application::where('email', $email)
        //                             ->where('status', 0)
        //                             ->where('can_change', 0)->get()->first();             
        if(!empty($application)){
            $data = 1;
            return response()->json($data, 200);
        }else{
            $data = 0;
            return response()->json($data, 200);
        }
    }

    public function updateExistingLoan(Request $req)
    {
        $email = $req->toArray()['email']; 
        try{
            Application::where('email', $email)->update(['can_change' => 1]);
            $data = 1;
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = 0;
            return response()->json($data, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
        DB::beginTransaction();
        $form = $request->toArray();
        // dd($form);
        if ($form['package_personal'] == 'salary_advance') {
            $loan_type = 'GRZ Loan';
        }else{
            $loan_type = 'GRZ Loan';
        }
        
        if($request->file('tpin_file') !== null){               
            $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');                
        }

        if($request->file('payslip_file') !== null){               
            $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');         
        }

        $register = [
            'lname'=> $form['lname'],
            'fname'=> $form['name'],
            'mname'=> $form['mname'],
            'phone2'=> $form['phone2'],
            'email'=> $form['email'] ?? '',
            'password' => 'mighty4you',
            'terms' => 'accepted'
        ];
        $user = $this->registerUser($register);
        
        if($user !== 0){
            $data = [
                'lname'=> $form['lname'],
                'fname'=> $form['name'],
                'email'=> $form['email'],
                'amount'=> $form['amount'],
                'phone'=> $form['phone'],
                'gender'=> $form['gender'],
                'type'=> $loan_type,
                'repayment_plan'=> $form['repayment_plan'],
                'age'=> $form['age'],
                'cust_type'=> $form['customer_type'],
                'personal_loan_type'=> $loan_type,
                'nationality' => $form['nationality'],
                'tpin_file' => $tpin_file ?? 'no file',
                'payslip_file' => $payslip_file ?? 'no file',
                'user_id' =>  $user->id,
                'complete' => 0
            ];
            
            // $this->apply_loan($data);
            $res = $this->apply_loan($data);
            
            if($res == 'exists'){
                $loan = Application::where('status', 0)->where('complete', 0)
                                    ->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
                return response()->json([
                    "status" => 500, 
                    "success" => false, 
                    "message" => "Already have a Loan.",
                    "loan_id" => $loan->id,
                    "amount" => $loan->amount
                ]); 
            }else{
                
                $mail = [
                    'user_id' => $user->id,
                    'name' => $form['name'].' '.$form['lname'],
                    'loan_type' => $form['type'].' '.$form['package_personal'],
                    'phone' => $form['phone'],
                    'duration' => $form['repayment_plan'],
                    'amount' => $form['amount'],
                    'type' => 'loan-application',
                    'msg' => 'You have new a '.$form['type'].' loan application request, please visit the site to view more details'
                ];  
        
                // Send information to the admin
                $this->send_loan_email($mail);
                
                DB::commit();
                return response()->json([
                    "status" => 200, 
                    "success" => true, 
                    "message" => "Your loan has been sent."
                ]); 
            }
    
        }else{
            
            DB::rollback();
            dd('failed');
            return response()->json([
                "status" => 500, 
                "success" => false, 
                "message" => "Failed to submit your loan request, please try again."
            ]); 
        }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function updateFiles(Request $request)
    {
        // DB::beginTransaction();  
        try {
            $user = Application::where('user_id',auth()->user()->id)->where('status', 0)->where('complete', 0)->first();

            if($request->file('nrc_file') !== null){
                $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public'); 
                $user->nrc_file = $nrc_file;
                $user->save();      
            }
    
            if($request->file('tpin_file') !== null){               
                $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');   
                $user->tpin_file = $tpin_file;
                $user->save();           
            }
    
            if($request->file('payslip_file') !== null){               
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');  
                $user->payslip_file = $payslip_file;
                $user->save();        
            }

            $this->isKYCComplete();
            
            // DB::commit();
            return redirect()->to('/user/profile');
        } catch (\Throwable $th) {
            dd($th);
            // DB::rollback();
            return redirect()->to('/user/profile');
        }

    }

    public function updateKYCFiles(Request $request){
        try {
            // First Upload the files
            $this->uploadCommonFiles($request);

            // Personal Info
            $input = $request->toArray();
            $user = auth()->user();
            $user->fname = $input['fname'];
            $user->lname = $input['lname'];
            $user->phone = $input['phone'];
            // $user->email = $input['email'];
            $user->address = $input['address'];
            $user->occupation = $input['occupation'];
            $user->id_type = $input['id_type'];
            $user->nrc_no = $input['nrc_no'];
            $user->nrc = $input['nrc_no'];
            $user->dob = $input['dob'];
            $user->gender = $input['gender'];
            $user->save();

            $this->isKYCComplete();
            return redirect()->route('dashboard')->with('success', 'KYC Updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('success', 'KYC Update failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function new_loan(Request $request)
    {
        $form = $request->toArray();
        // Remove non-numeric characters
        $amount = intval(str_replace(['K', ',', '$', "'", '"', ' '], '', $form['amount']));
        
        DB::beginTransaction();
        try {
            
            // First Upload the files
            $this->uploadCommonFiles($request);
    
            $data = [
                'user_id'=> auth()->user()->id,
                'lname'=> auth()->user()->lname,
                'fname'=> auth()->user()->fname,
                'email'=>  auth()->user()->email,
                'amount'=> $amount,
                'gender'=> auth()->user()->gender,
                'type'=> $form['loan_type'],
                'repayment_plan'=> $form['duration'],
                'personal_loan_type'=> $form['loan_type'],
                'status' => 0,
                'continue' => 1
            ];
            $application = $this->apply_loan($data);
            $this->isKYCComplete();
            $mail = [
                'user_id' => auth()->user()->id,
                'application_id' => $application,
                'name' => $data['fname'].' '.$data['lname'],
                'loan_type' => $data['type'],
                'duration' => $data['repayment_plan'],
                'amount' => $data['amount'],
                'type' => 'loan-application',
                'msg' => 'You have new a '.$data['type'].' loan application request, please visit the site to view more details'
            ];
            $process = $this->send_loan_email($mail);
            
            if($request->wantsJson()){
                return response()->json([
                    "status" => 200, 
                    "success" => true, 
                    "message" => "Your loan has been sent.", 
                    "data" => $application
                ]);
            }else{
                if($process){
                    DB::commit();
                    Session::flash('success', "Loan created successfully. ");
                    return redirect()->route('view-loan-requests');
                }else{
                    DB::commit();
                    Session::flash('success', "Loan created successfully, Email could not be sent to the Borrower. ");
                    return redirect()->route('view-loan-requests');
                }
            }  
        } catch (\Throwable $th) {
            DB::rollback();
            Session::flash('error', "Loan could not be created, check your internet connection and try again. ");
            return redirect()->back();
        }     
    }


    public function new_proxy_loan(Request $request)
    {
        DB::beginTransaction();
        try {
            $form = $request->toArray();
            // dd($form);
            // Add Payslip and TPIN file if they are uploaded
            if($request->file('tpin_file') !== null){               
                $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');                
            }
            if($request->file('payslip_file') !== null){               
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');         
            }
            if($request->file('nrc_file') !== null){               
                $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public');         
            }
    
            // Update the User's Basic & Net Pay (Automatically placed in the input field)
            $user = User::where('id', $form['borrower_id'])->first();
            $user->basic_pay = $form['basic_pay'];
            $user->net_pay = $form['net_pay'];
            $user->save();
            
            // Collect the loan application data
            $data = [
                'user_id'=> $form['borrower_id'],
                'lname'=> $user->lname,
                'fname'=> $user->fname,
                'email'=> $user->email ?? '',
                'amount'=> $form['amount'],
                'phone'=> $user->phone,
                'gender'=> $user->gender,
                'type'=> $form['type'],
                'repayment_plan'=> $form['repayment_plan'],

                'glname'=> $form['glname'],
                'gfname'=> $form['gfname'],
                'gemail'=> $form['gemail'],
                'gphone'=> $form['gphone'],
                'g_gender'=> $form['g_gender'],
                'g_relation'=> $form['g_relation'],
    
                'g2lname'=> $form['g2lname'],
                'g2fname'=> $form['g2fname'],
                'g2email'=> $form['g2email'],
                'g2phone'=> $form['g2phone'],
                'g2_gender'=> $form['g2_gender'],
                'g2_relation'=> $form['g2_relation'],
    
                'tpin_file' => $tpin_file ?? 'no file',
                'payslip_file' => $payslip_file ?? 'no file',
                'nrc_file' => $nrc_file ?? 'no file',
                
                'doa' => $form['datepicker'],
                'processed_by'=> auth()->user()->id
            ];
            // Skip the updating of KYC
            if($form['bypass']){
                $data['complete'] = 1;
            }else{
                $data['complete'] = 0;
            }


            // Enter Next of King if its personal loan
            if($form['type'] !== 'Asset Financing'){
                $nok = [
                    'nok_email' => $form['nok_email'],
                    'nok_fname' => $form['nok_fname'],
                    'nok_lname' => $form['nok_lname'],
                    'nok_phone' => $form['nok_phone'],
                    'nok_relation' => $form['nok_relation'],
                    'nok_gender' => $form['nok_gender'],
                    'user_id' => $form['borrower_id']
                ];
                $this->createNOK($nok);
            }

            // Create a loan request application and send email to borrower
            $application = $this->apply_loan($data);

            // Send Email to Admin about this new loan
            $mail = [
                'user_id' => '',
                'application_id' => $application,
                'name' => $user->fname.' '.$user->lname,
                'loan_type' => $form['type'],
                'phone' => $user->phone,
                'duration' => $form['repayment_plan'],
                'amount' => $form['amount'],
                'type' => 'loan-application',
                'msg' => 'You have new a '.$form['type'].' loan application request from '.$user->fname.' '.$user->lname.', please visit the site to view more details'
            ];
    
            // Email going to the Administrator
            $process = $this->send_loan_email($mail);
    
            if($request->wantsJson()){
                return response()->json([
                    "status" => 200, 
                    "success" => true, 
                    "message" => "Your loan has been sent.", 
                    "data" => $application
                ]);
            }else{
                if($process){
                    DB::commit();
                    return redirect()->route('view-loan-requests');
                }else{
                    DB::commit();
                    return redirect()->back();
                }
            } 
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back();
        }      
    }

    public function updateLoanDetails(Request $request)
    {
        DB::beginTransaction();
        try {
            $form = $request->toArray();
      
            // Update files
            if($request->file('tpin_file') !== null){               
                $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');                
            }
    
            if($request->file('payslip_file') !== null){               
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');         
            }
    
            if($request->file('nrc_file') !== null){               
                $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public');         
            }
    
            // Update User info
            $loan_req = Application::where('id', $form['loan_id'])->first();
            $user = User::where('id', $form['borrower_id'])->first();
            $user->basic_pay = $form['basic_pay'];
            $user->net_pay = $form['net_pay'];
            $user->save();
            
            // Update Application Details
            $data = [
                'user_id'=> $form['borrower_id'],
                'lname'=> $user->lname,
                'fname'=> $user->fname,
                'email'=> $user->email ?? '',
                'amount'=> $form['amount'],
                'phone'=> $user->phone,
                'gender'=> $user->gender,
                'type'=> $form['type'],
                'repayment_plan'=> $form['repayment_plan'],

                'glname'=> $form['glname'],
                'gfname'=> $form['gfname'],
                'gemail'=> $form['gemail'],
                'gphone'=> $form['gphone'],
                'g_gender'=> $form['g_gender'],
                'g_relation'=> $form['g_relation'],
    
                'g2lname'=> $form['g2lname'],
                'g2fname'=> $form['g2fname'],
                'g2email'=> $form['g2email'],
                'g2phone'=> $form['g2phone'],
                'g2_gender'=> $form['g2_gender'],
                'g2_relation'=> $form['g2_relation'],

                'doa' => $form['doa'] ?? $loan_req->doa,

                'tpin_file' => $form['tpin_file'] ?? $tpin_file,
                'payslip_file' => $form['payslip_file'] ?? $payslip_file,
                'nrc_file' => $form['nrc_file'] ?? $nrc_file,
                'complete' => $form['complete'],
                'processed_by'=> auth()->user()->id
            ];

            // Enter Next of King if its personal loan
            if($form['type'] !== 'Asset Financing'){
                $nok = [
                    'nok_email' => $form['nok_email'],
                    'nok_fname' => $form['nok_fname'],
                    'nok_lname' => $form['nok_lname'],
                    'nok_phone' => $form['nok_phone'],
                    'nok_relation' => $form['nok_relation'],
                    'nok_gender' => $form['nok_gender'],
                    'user_id' => $form['borrower_id']
                ];
                $this->updateNOK($nok);
            }

            $application = $this->apply_update_loan($data, $form['loan_id']);
            if($form['loan_status'] == 1){
                // Update borrower wallet
                $this->updateUserWallet($form['borrower_id'], $form['amount'], $form['old_amount']);
                
                // Delete Withdrawal requests
                WithdrawRequest::where('user_id', '=', $form['borrower_id'])->delete();

                // Update due date
                if($form['new_due_date'] !== null){
                    $this->remake_loan($form['loan_id'], $form['new_due_date']);
                }
            }

            $mail = [
                'user_id' => '',
                'application_id' => $application,
                'name' => $user->fname.' '.$user->lname,
                'loan_type' => $form['type'],
                'phone' => $user->phone,
                'duration' => $form['repayment_plan'],
                'amount' => $form['amount'],
                'type' => 'loan-application',
                'msg' => 'You have new a '.$form['type'].' loan application request from '.$user->fname.' '.$user->lname.' has been updated, please visit the site to view more details'
            ];
    
            // Email going to the Administrator
            $process = $this->send_loan_email($mail);
    
            if($request->wantsJson()){
                return response()->json([
                    "status" => 200, 
                    "success" => true, 
                    "message" => "Your loan has been sent.", 
                    "data" => $application
                ]);
            }else{
                if($process){
                    DB::commit();
                    return redirect()->back();
                }else{
                    DB::commit();
                    return redirect()->back();
                }
            } 
            
            DB::commit();
            return redirect()->route('view-loan-requests');
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollback();
            return redirect()->back();
        }      
    }
    public function continue_loan(Request $request){
        try {
            $data = $request->toArray();
           
            // First Upload the files
            $this->uploadCommonFiles($request);

            // Update Personal Info & KYC status
            $personal = [
                'dob' => $data['dob'],
                'nrc_no' => $data['nrc'],
                'phone' => $data['phone'],
                'employeeNo' => $data['employeeNo'],
                'jobTitle' => $data['jobTitle'],
                'ministry' => $data['ministry'],
                'department' => $data['department'],
                'borrower_id' => $data['borrower_id'],
                'gender'=> $data['gender']
            ];
            $nok = [
                'nok_fname' => $data['nextOfKinFirstName'],
                'nok_lname' => $data['nextOfKinLastName'],
                'nok_phone' => $data['nextOfKinPhone'],
                'nok_relation' => $data['relationship'],
                'nok_address' => $data['physicalAddress'],
                'user_id' => $data['borrower_id']
            ];
            $guarants = [
                'gfname'=> $data['guarantorName'],
                'gnrc_no'=> $data['guarantorNRC'],
                'gdob'=> $data['guarantorDOB'],
                'gphone'=> $data['guarantorContactNumber'],
                'gphone2'=> $data['alternativeNumber'],
                'gphonesp3'=> $data['spouseContactNumber'],
                'gaddress'=> $data['guarantorAddress'],
                'g_relation'=> $data['relationshipToBorrower'],
                'application_id' => $data['application_id']
            ];
            $refs = [
                'hrFname'=> $data['hrFirstName'],
                'hrLname'=> $data['hrLastName'],
                'hrContactNumber'=> $data['hrContactNumber'],
                'supervisorFirstName'=> $data['supervisorFirstName'],
                'supervisorLastName'=> $data['supervisorLastName'],
                'supervisorContactNumber'=> $data['supervisorContactNumber'],
                'user_id' => $data['borrower_id'],
                'application_id' => $data['application_id']
            ];
            $bank = [
                'bankName'=> $data['bankName'],
                'branchName'=> $data['branchName'],
                'accountNames'=> $data['accountNames'],
                'accountNumber'=> $data['accountNumber'],
                'user_id' => $data['borrower_id'],
            ];


            $this->updateUser($personal);
            if (isset($data['application_id'])) {
                $loan = Application::where('id', $data['application_id'])->first();
                $loan->save();
            }
            
            // Create Next of Kin
            $this->createNOK($nok);
    
            // Update Guarantors
            $this->updateGuarantors($guarants);
    
            // Update reference details
            $this->createRefs($refs);
    
            // Update bank details
            $this->createBankDetails($bank);
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function destroy($id)
    {
        //
    }
}
