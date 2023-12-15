<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Application;
use App\Models\Wallet;
use App\Models\WithdrawRequest;
use App\Traits\EmailTrait;
use App\Traits\LoanTrait;
use App\Traits\UserTrait;
use App\Traits\WalletTrait;
use Livewire\Component;
use Illuminate\Support\Str;

class DashboardView extends Component
{

    use EmailTrait, WalletTrait, LoanTrait, UserTrait;
    public $loan_requests, $loan_request, $all_loan_requests, $my_loan, $wallet;
    public $payment_method, $withdraw_amount, $mobile_number, $card_name, $bank_name, $card_number;

    public function render()
    {
        
        $this->isKYCComplete();
        if (auth()->user()->hasRole('user')) {
            $this->all_loan_requests = Application::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(5)->get();
        }else{
            $this->all_loan_requests = Application::orderBy('created_at', 'desc')->take(5)->get();
        }
        $this->my_loan = $this->getCurrentLoan();
        $this->wallet = $this->getWalletBalance(auth()->user());
        
        return view('livewire.dashboard.dashboard-view')
        ->layout('layouts.dashboard');
    }

    public function submitWithdrawRequest(){
        $uuid = Str::orderedUuid();
        WithdrawRequest::create([
            'wallet_id' => Wallet::where('user_id', auth()->user()->id)->first()->id,
            'amount' => $this->withdraw_amount,
            'ref' => substr($uuid, 0, 6),
            'withdraw_method' => $this->payment_method,
            'mobile_number' => $this->mobile_number,
            'card_name' => $this->card_name,
            'bank_name' => $this->bank_name,
            'comments' => 'You have received a new wallet withdraw request',
            'card_number' => $this->card_number,
            'user_id' => auth()->user()->id
        ]);
        session()->flash('success', 'Your withdraw request has been sent');
    }

    public function approve($id){
        try {
            $x = Application::find($id);
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
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been successfully accepted'
            ];
            $this->send_loan_feedback_email($mail);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function stall($id){
        // set under review
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
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application is under review'
            ];
            $this->send_loan_feedback_email($mail);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function reject($id){
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
                'type' => 'loan-application',
                'msg' => 'Your '.$x->type.' loan application request has been rejected'
            ];
            $this->send_loan_feedback_email($mail);

        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
