<?php

namespace App\Http\Livewire\Dashboard\Loans;

use Livewire\Component;

class NewLoanView extends Component
{
    public function render()
    {
        return view('livewire.dashboard.loans.new-loan-view')
        ->layout('layouts.dashboard');
    }
}
