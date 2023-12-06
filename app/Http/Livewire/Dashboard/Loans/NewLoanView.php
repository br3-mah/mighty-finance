<?php

namespace App\Http\Livewire\Dashboard\Loans;

use App\Traits\UserTrait;
use Livewire\Component;

class NewLoanView extends Component
{
    use UserTrait;
    public function render()
    {
        return view('livewire.dashboard.loans.new-loan-view')
        ->layout('layouts.dashboard');
    }
}
