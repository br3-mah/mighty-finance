<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
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
        $form = $request->toArray();
        dd($form);
        if($request->file('tpin_file') !== null){               
            $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');                
        }

        if($request->file('payslip_file') !== null){               
            $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');         
        }

        $register = [
            'lname'=> $form['lname'],
            'fname'=> $form['fname'],
            'email'=> $form['email'] ?? '',
            'password' => 'mighty4you',
            'terms' => 'accepted'
        ];
        $user = $this->registerUser($register);
        if(!$user){
            return redirect()->to('/account-already-exists');
        }
        $data = [
            'lname'=> $form['lname'],
            'fname'=> $form['fname'],
            'email'=> $form['email'],
            'amount'=> $form['amount'],
            'phone'=> $form['phone'],
            'gender'=> $form['gender'],
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
            'user_id' =>  $user->id,
            'complete' => 0
        ];

        // Enter Next of King if its personal loan
        if($form['type'] !== 'Asset Financing' ){
            $nok = [
                'nok_email' => $form['nok_email'],
                'nok_fname' => $form['nok_fname'],
                'nok_lname' => $form['nok_lname'],
                'nok_phone' => $form['nok_phone'],
                'nok_relation' => $form['nok_relation'],
                'nok_gender' => $form['nok_gender'],
                'user_id' => $user->id
            ];
            $this->createNOK($nok);
        }
        
        $this->apply_loan($data);
        // $application = $this->apply_loan($data);
        $mail = [
            'user_id' => $user->id,
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
                "message" => "Your loan has been sent."
                // "data" => $application
            ]);
        }else{
            if($process){
                return redirect()->to('/successfully-applied-a-loan');
            }else{
                return redirect()->to('/contact-us');
            }
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
        // dd('here');
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
                'lname'=> $form['lname'],
                'fname'=> $form['fname'],
                'email'=> $form['email'],
                'amount'=> $form['amount'],
                'phone'=> $form['phone'],
                'gender'=> $form['gender'],
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
    
                'complete' => 0
            ];
            if($form['type'] !== 'Asset Financing' ){
                $nok = [
                    'nok_email' => $form['nok_email'],
                    'nok_fname' => $form['nok_fname'],
                    'nok_lname' => $form['nok_lname'],
                    'nok_phone' => $form['nok_phone'],
                    'nok_relation' => $form['nok_relation'],
                    'nok_gender' => $form['nok_gender'],
                    'user_id' => $form['user_id']
                ];
                $this->createNOK($nok);
            }
            $application = $this->apply_loan($data);
            $mail = [
                'user_id' => '',
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
                    return redirect()->back();
                }else{
                    DB::commit();
                    Session::flash('success', "Loan created successfully, Email could not be sent to the Borrower. ");
                    return redirect()->back();
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



    public function destroy($id)
    {
        //
    }
}
