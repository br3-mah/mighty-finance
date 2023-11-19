<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Models\UserFile;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Traits\EmailTrait;
use App\Traits\LoanTrait;
use App\Traits\UserTrait;
use App\Traits\WalletTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoanApplicationController extends Controller
{     
    use EmailTrait, LoanTrait, UserTrait, WalletTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'password' => 'Mighty4you',
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
            // dd($res);
            if($res == 'exists'){
                return response()->json([
                    "status" => 500, 
                    "success" => false, 
                    "message" => "Already have a Loan."
                ]); 
            }

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
        DB::beginTransaction();
        $i = auth()->user();   
        try {
            if($request->file('nrc_file') !== null){
                $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public'); 
                $user = Application::where('user_id',auth()->user()->id)->where('status', 0)->where('complete', 0)->first();
                $user->nrc_file = $nrc_file;
                $user->save();      
            }
    
            if($request->file('tpin_file') !== null){               
                $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');   
                $user = Application::where('user_id',auth()->user()->id)->where('status', 0)->where('complete', 0)->first();
                $user->tpin_file = $tpin_file;
                $user->save();           
            }
    
            if($request->file('payslip_file') !== null){               
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');  
                $user = Application::where('user_id',auth()->user()->id)->where('status', 0)->where('complete', 0)->first();
                $user->payslip_file = $payslip_file;
                $user->save();        
            }

            if($i->id_type !== null && $i->net_pay !== null && $i->basic_pay !== null && $i->address !== null && $i->phone !== null && $i->occupation !== null && $i->gender !== null && $i->nrc_no !== null && $i->dob !== null){
                $loan = Application::where('status', 0)->where('complete', 0)
                            ->where('user_id', auth()->user()->id)->first();
                            
                if($loan !== null){
                    if($loan->tpin_file !== 'no file' && $loan->payslip_file !== 'no file' && $loan->nrc_file !== null){
                        // dd('here in loan');
                        $loan->complete = 1;
                        $loan->save();
                        DB::commit();
                        return redirect()->to('/dashboard');
                    }
                }
            }
            
            DB::commit();
            return redirect()->to('/user/profile');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->to('/user/profile');
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

        DB::beginTransaction();
        try {
            $form = $request->toArray();
            // dd($form);
            if($request->file('tpin_file') !== null){               
                $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');                
            }
    
            if($request->file('payslip_file') !== null){               
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');         
            }
    
            $data = [
                'user_id'=> auth()->user()->id,
                'lname'=> auth()->user()->lname,
                'fname'=> auth()->user()->fname,
                'email'=>  auth()->user()->email,
                'amount'=> $form['amount'],
                // 'phone'=> $form['phone'],
                'gender'=> auth()->user()->gender,
                'type'=> $form['loan_type'],
                'repayment_plan'=> $form['duration'],
                'cust_type'=> $form['customer_type'],
                'personal_loan_type'=> $form['personal_loan_type'],
                'tpin_file' => $tpin_file ?? 'no file',
                'payslip_file' => $payslip_file ?? 'no file',
                'complete' => 0
            ];
            // if($form['type'] !== 'Asset Financing' ){
            //     $nok = [
            //         'nok_email' => $form['nok_email'],
            //         'nok_fname' => $form['nok_fname'],
            //         'nok_lname' => $form['nok_lname'],
            //         'nok_phone' => $form['nok_phone'],
            //         'nok_relation' => $form['nok_relation'],
            //         'nok_gender' => $form['nok_gender'],
            //         'user_id' => $form['user_id']
            //     ];
            //     $this->createNOK($nok);
            // }
            $application = $this->apply_loan($data);
            $mail = [
                'user_id' => auth()->user()->id,
                'application_id' => $application,
                'name' => $form['fname'].' '.$form['lname'],
                'loan_type' => $form['type'],
                'phone' => $form['phone'],
                'duration' => $form['repayment_plan'],
                'amount' => $form['amount'],
                'type' => 'loan-application',
                'msg' => 'You have new a '.$form['type'].' loan application request, please visit the site to view more details'
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
            // dd($data);
            if($request->file('preapproval') !== null){               
                $preapproval = $request->file('preapproval')->store('preapproval', 'public'); 
                UserFile::create([
                    'name' => $request->file('preapproval')->getClientOriginalName(),
                    'path' => $preapproval,
                    'user_id' => auth()->user()->id
                ]);               
            }
            if($request->file('passport') !== null){               
                $passport = $request->file('passport')->store('passport', 'public');
                UserFile::create([
                    'name' => $request->file('passport')->getClientOriginalName(),
                    'path' => $passport,
                    'user_id' => auth()->user()->id
                ]);                
            }
            if($request->file('bankstatement') !== null){               
                $bankstatement = $request->file('bankstatement')->store('bankstatement', 'public');
                UserFile::create([
                    'name' => $request->file('bankstatement')->getClientOriginalName(),
                    'path' => $bankstatement,
                    'user_id' => auth()->user()->id
                ]);                 
            }
    
            if($request->file('payslip_file') !== null){               
                $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');
                UserFile::create([
                    'name' => $request->file('payslip_file')->getClientOriginalName(),
                    'path' => $payslip_file,
                    'user_id' => auth()->user()->id
                ]);          
            }
    
            if($request->file('nrc_file') !== null){               
                $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public');
                UserFile::create([
                    'name' => $request->file('nrc_file')->getClientOriginalName(),
                    'path' => $nrc_file,
                    'user_id' => auth()->user()->id
                ]);         
            }
            // Update Personal Info & KYC status
            $personal = [
                'dob' => $data['dob'],
                'nrc_no' => $data['nrc'],
                'phone' => $data['phone'],
                'employeeNo' => $data['employeeNo'],
                'jobTitle' => $data['jobTitle'],
                'ministry' => $data['ministry'],
                'department' => $data['department'],
                'borrower_id' => $data['borrower_id']
            ];
            $this->updateUser($personal);
            $loan = Application::where('id', $data['application_id'])->first();
            $loan->complete = 1;
            $loan->save();
            // Handle file uploads
            // if (array_key_exists('files', $data) && is_array($data['files'])) {
            //     foreach ($data['files'] as $file) {
            //         // Store the file in the storage/app/public directory (you can change the path as needed)
            //         $path = $file->store('public/user_files');
                    
            //         // Save the file path in the database if you have a table for file records
            //         UserFile::create([
            //             'name' => $file->getClientOriginalName(),
            //             'path' => $path,
            //             'user_id' => $data['borrower_id']
            //         ]);
            //     }
            // }
            // Create Next of Kin
            $nok = [
                'nok_fname' => $data['nextOfKinFirstName'],
                'nok_lname' => $data['nextOfKinLastName'],
                'nok_phone' => $data['nextOfKinPhone'],
                'nok_relation' => $data['relationship'],
                'nok_address' => $data['physicalAddress'],
                'user_id' => $data['borrower_id']
            ];
            $this->createNOK($nok);
    
    
            // Update Guarantors
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
        
            $this->updateGuarantors($guarants);
    
    
    
            // Update reference details
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
            $this->createRefs($refs);
    
            // Update bank details
            $bank = [
                'bankName'=> $data['bankName'],
                'branchName'=> $data['branchName'],
                'accountNames'=> $data['accountNames'],
                'accountNumber'=> $data['accountNumber'],
                'user_id' => $data['borrower_id'],
            ];
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
