<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Models\Application;
use App\Models\User;
use App\Traits\EmailTrait;
use App\Traits\LoanTrait;
use App\Traits\WalletTrait;
use Illuminate\Http\Client\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LoanDetailView extends Component
{
    use EmailTrait, WalletTrait, LoanTrait;
    public $loan, $user, $loan_id, $msg, $due_date;

    public function mount($id){
        /**
            *loan main details
            *Loan owner
            *Loan status timeline
        **/  
        $this->loan_id = $id;
    }

    public function render()
    {
        $this->loan = $this->get_loan_details($this->loan_id);
        // dd($this->loan->user->uploads[0]->path);
        return view('livewire.dashboard.loans.loan-detail-view')
        ->layout('layouts.dashboard');
    } 

    public function confirm($id, $msg){
        $this->loan_id = $id;
        $this->msg = $msg;
    }

    public function clear(){
        $this->loan_id = '';
        $this->msg = '';
    }
    
    public function accept($id){
        
        DB::beginTransaction();
        try {
            $x = Application::find($id);
            $this->make_loan($x, $this->due_date);
            if($this->isCompanyEnough($x->amount)){
                $x->status = 1;
                $x->save();
                if($x->email != null){
                    $mail = [
                        'user_id' => '',
                        'application_id' => $x->id,
                        'name' => $x->fname.' '.$x->lname,
                        'loan_type' => $x->type,
                        'phone' => $x->phone,
                        'email' => $x->email,
                        'duration' => $x->repayment_plan,
                        'amount' => $x->amount,
                        'payback' => Application::payback($x->amount, $x->repayment_plan),
                        'type' => 'loan-application',
                        'msg' => 'Your '.$x->type.' loan application request has been successfully accepted'
                    ];
                    $this->send_loan_feedback_email($mail);
                }
                $this->deposit($x->amount, $x);
                DB::commit();
                session()->flash('success', 'Successfully transfered '.$x->amount.' to '.$x->fname.' '.$x->lname);
            }else{
                session()->flash('warning', 'Insuficient funds in the company account, please update funds.');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            session()->flash('error', 'Oops something failed here, please contact the Administrator.'.$th);
        }
    }
    
    public function acceptOnly($id){
        try {
            $x = Application::find($id);
            if($this->isCompanyEnough($x->amount)){
                $x->status = 1;
                $x->save();
                $mail = [
                    'user_id' => '',
                    'application_id' => $x->id,
                    'name' => $x->fname.' '.$x->lname,
                    'loan_type' => $x->type,
                    'phone' => $x->phone,
                    'email' => $x->email,
                    'duration' => $x->repayment_plan,
                    'amount' => $x->amount,
                    'payback' => Application::payback($x->amount, $x->repayment_plan),
                    'type' => 'loan-application',
                    'msg' => 'Your '.$x->type.' loan application request has been successfully accepted'
                ];
                $this->send_loan_feedback_email($mail);
                session()->flash('success', 'Successfully approved');
            }else{
                session()->flash('warning', 'Insuficient funds in the company account, please update funds.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }


    public function stall($id){
        try {
            $x = Application::find($id);
            $x->status = 2;
            $x->save();
            
            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application is under review'
            ];
            $this->send_loan_feedback_email($mail);
            $this->render();
            session()->flash('info', 'Application is under review.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }


    public function reverse($id){
        try {
            $x = Application::find($id);
            $x->status = 3;
            $x->save();
            
            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been rejected'
            ];
            $this->withdraw($x->amount, $x);
            $this->send_loan_feedback_email($mail);
            session()->flash('success', 'Loan has been rejected');
        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }

    public function rejectOnly($id){
        try {
            $x = Application::find($id);
            $x->status = 3;
            $x->save();
            
            $mail = [
                'user_id' => '',
                'application_id' => $x->id,
                'name' => $x->fname.' '.$x->lname,
                'loan_type' => $x->type,
                'phone' => $x->phone,
                'email' => $x->email,
                'duration' => $x->repayment_plan,
                'amount' => $x->amount,
                'payback' => Application::payback($x->amount, $x->repayment_plan),
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been rejected'
            ];
            $this->send_loan_feedback_email($mail);
            session()->flash('success', 'Loan has been rejected');
        } catch (\Throwable $th) {
            session()->flash('error', 'Oops something failed here, please contact the Administrator.');
        }
    }


}
