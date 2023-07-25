<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Classes\Exports\ClosedLoanExport;
use App\Models\Application;
use App\Models\Loans;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ClosedLoanView extends Component
{
    public $loan_requests;
    public function render()
    {
        if (auth()->user()->hasRole('user')) {
            $this->loan_requests = Loans::with(['application' => function($q){
                $q->where('user_id', auth()->user()->id);
            }])->where('closed', 1 )->orderBy('id', 'desc')->get();
        } else {
            $this->loan_requests = Loans::with('application')->where('closed', 1 )->orderBy('id', 'desc')->get();
        }
        return view('livewire.dashboard.loans.closed-loan-view')
        ->layout('layouts.dashboard');
    }

    public function exportClosedLoans(){
        return Excel::download(new ClosedLoanExport(), 'Closed Loans.xlsx');
    }
}
