<?php

namespace App\Traits;

use App\Jobs\SendLoanRequestEmailJob;
use App\Mail\LoanApplication;
use App\Mail\LoanEquiry;
use App\Models\Application;
use App\Models\User;
use App\Notifications\BTFLoanRequest;
use App\Notifications\LoanRemainder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Mail\ContactEmail;

trait EmailTrait{

    // This email send a contact message from contact us page /////////////
    public function send_contact_email($details){
        try {
            // dispatch(new SendLoanRequestEmailJob($details));
            $contact_email = new ContactEmail($details);
            Mail::to($this->emailData['to'])->send($contact_email);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // This email notifies the administrator about a new loan request //////////////////
    public function send_loan_email($data){
        $admin = User::first();
        try {
            Notification::send($admin, new BTFLoanRequest($data));
            return true;
        } catch (\Throwable $th) {
            return false;
        }

    }

    // This email notifies the customer email that their application for a loan has been sumbitted //////
    public function send_loan_feedback_email($data){
        try {
            $contact_email = new LoanApplication($data);
            Mail::to($data['to'])->send($contact_email);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    // This email sends details to the administrator for prospect customer loan enqury
    public function send_loan_enquiry($data){
        $admin = User::first();
        try {
            Mail::to($admin->email)->send(new LoanEquiry($data));
        } catch (\Throwable $th) {
            return $th;
        }
    } 

    
    // This email send a contact message from contact us page /////////////
    public function send_loan_remainder($data, $user){
        try {
            Notification::send($user, new LoanRemainder($data));
            return true;
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
    }

}