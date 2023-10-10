<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\PostController;
use App\Http\Livewire\AboutPage;
use App\Http\Livewire\AlreadyExistPage;
use App\Http\Livewire\CareerPage;
use App\Http\Livewire\ContactPage;
use App\Http\Livewire\Dashboard\Accounting\LoanStatementView;
use App\Http\Livewire\Dashboard\Accounts\AccountView;
use App\Http\Livewire\Dashboard\Accounts\MakePaymentView;
use App\Http\Livewire\Dashboard\Borrowers\BorrowerView;
use App\Http\Livewire\Dashboard\Borrowers\LoanStatementView as BorrowersLoanStatementView;
use App\Http\Livewire\Dashboard\Borrowers\SendBorrowerMessageView;
use App\Http\Livewire\Dashboard\DashboardView;
use App\Http\Livewire\Dashboard\Employees\EmployeesView;
use App\Http\Livewire\Dashboard\Loans\ClosedLoanView;
use App\Http\Livewire\Dashboard\Loans\CreateLoanView;

use App\Http\Livewire\Dashboard\Loans\EligibilityScoreView;
use App\Http\Livewire\Dashboard\Loans\GuarantorsView;
use App\Http\Livewire\Dashboard\Loans\LoanApplicationStandaloneView;
use App\Http\Livewire\Dashboard\Loans\LoanDetailView;
use App\Http\Livewire\Dashboard\Loans\LoanHistoryView;
use App\Http\Livewire\Dashboard\Loans\LoanRatesView;
use App\Http\Livewire\Dashboard\Loans\LoanRepaymentCalculatorView;
use App\Http\Livewire\Dashboard\Loans\LoanRepaymentView;
use App\Http\Livewire\Dashboard\Loans\LoanRequestView;
use App\Http\Livewire\Dashboard\Loans\LoanTrackingView;
use App\Http\Livewire\Dashboard\Loans\MissedRepaymentsView;
use App\Http\Livewire\Dashboard\Loans\NewLoanView;
use App\Http\Livewire\Dashboard\Loans\PastMaturityDateView;
use App\Http\Livewire\Dashboard\Loans\UpdateLoanView;
use App\Http\Livewire\Dashboard\NotificationView;
use App\Http\Livewire\Dashboard\SearchEngineView;
use App\Http\Livewire\Dashboard\Settings\LoanWalletView;
use App\Http\Livewire\Dashboard\Settings\UserRolesView;
use App\Http\Livewire\Dashboard\Settings\UserView;
use App\Http\Livewire\Dashboard\Settings\CareerSettings;
use App\Http\Livewire\Dashboard\Settings\ContactSettings;
use App\Http\Livewire\Dashboard\Settings\UserUpdateView;
use App\Http\Livewire\FaqPage;
use App\Http\Livewire\KYCView;
use App\Http\Livewire\Loans\AssetFinanceLoan;
use App\Http\Livewire\Loans\EducationalLoan;
use App\Http\Livewire\Loans\HomeLoan;
use App\Http\Livewire\Loans\PersonalLoan;
use App\Http\Livewire\Loans\SMELoan;
use App\Http\Livewire\Loans\VehicleLoan;
use App\Http\Livewire\Loans\WIBLoan;
use App\Http\Livewire\PersonFour;
use App\Http\Livewire\PersonOne;
use App\Http\Livewire\PersonThree;
use App\Http\Livewire\PersonTwo;
use App\Http\Livewire\ReportView;
use App\Http\Livewire\ServicePage;
use App\Http\Livewire\SuccessEmailPage;
use App\Http\Livewire\SuccessPage;
use App\Http\Livewire\TeamPage;
use App\Http\Livewire\WelcomePage;
use App\Http\Livewire\WithdrawRequestView;
use App\Models\LoanWallet;
use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/foo', function () {
//     Artisan::call('storage:link');
// });
Route::get('/', WelcomePage::class)->name('welcome');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::get('/dashboard', DashboardView::class)->name('dashboard');
    Route::get('/search', SearchEngineView::class)->name('search');
    // Administrator
    Route::get('new-loan-request', NewLoanView::class)->name('new-loan');
    Route::get('client-loan-requests', LoanRequestView::class)->name('view-loan-requests');
    Route::get('active-repayments', LoanRepaymentView::class)->name('repayments');
    Route::get('track-repayments/{id}', LoanTrackingView::class)->name('track-repayments');
    Route::get('closed-loans', ClosedLoanView::class)->name('closed-loans');
    Route::get('edit-loan-details/{id}', UpdateLoanView::class)->name('edit-loan');
    Route::get('new-customer', CreateLoanView::class)->name('proxy-loan-create');
    Route::get('withdraw-requests', WithdrawRequestView::class)->name('withdraw-requests');
    Route::get('client-loan-history', LoanHistoryView::class)->name('view-loan-history');
    Route::get('loan-rates', LoanRatesView::class)->name('view-loan-rates');
    Route::get('repayment-calculator', LoanRepaymentCalculatorView::class)->name('view-repayment-calculator');
    Route::get('edit-user/{id}', UserUpdateView::class)->name('edit-user');
    

    // ---- Borrowers
    Route::get('borrowers', BorrowerView::class)->name('borrowers');
    Route::get('loan-statement/{id}', BorrowersLoanStatementView::class)->name('loan-statement');
    Route::get('send-messages-to-borrowers', SendBorrowerMessageView::class)->name('notify-borrowers');

    // ---- loans
    Route::get('apply-for-a-loan/{id}', LoanApplicationStandaloneView::class)->name('apply-for');
    Route::get('loan-details/{id}', LoanDetailView::class)->name('loan-details');
    Route::get('past-maturity-date', PastMaturityDateView::class)->name('past-maturity-date');
    Route::get('guarantors', GuarantorsView::class)->name('guarantors');
    Route::get('missed-repayments', MissedRepaymentsView::class)->name('missed-repayments');
    Route::post('apply-for-loan', [LoanApplicationController::class, 'new_loan'])->name('apply-loan');
    Route::post('apply-proxy-loan', [LoanApplicationController::class, 'new_proxy_loan'])->name('proxy-apply-loan');
    Route::post('update-loan', [LoanApplicationController::class, 'updateLoanDetails'])->name('update-loan-details');
    
    // ---- Employees
    Route::get('view-employees', EmployeesView::class)->name('employees');

    // ---- Accounts
    Route::get('client-account', AccountView::class)->name('client-account');
    Route::get('loan-statements', LoanStatementView::class)->name('loan-statements');
    Route::get('loan-wallet-account', LoanWalletView::class)->name('loan-wallet');
    Route::get('transactions', MakePaymentView::class)->name('make-payment');

    // ----- Reports
    Route::get('reports/loan-report', ReportView::class)->name('loan-report');
    Route::get('reports/borrower-report', ReportView::class)->name('borrower-report');

    // ----- settings
    Route::get('users', UserView::class)->name('users');
    Route::get('loan-rates', LoanRatesView::class)->name('loan-rates');
    Route::get('careers-settings', CareerSettings::class)->name('careers-settings');
    Route::get('contact-settings', ContactSettings::class)->name('contact-settings');
    Route::post('/create-user', [UserController::class, 'store'])->name('create-user');
    Route::post('/update-user', [UserController::class, 'update'])->name('update-user');
    Route::get('notifications', NotificationView::class)->name('notifications');
    Route::get('user-roles-and-permissions', UserRolesView::class)->name('roles');

    // ------ KYC Profile
    Route::get('kyc-profile', KYCView::class)->name('kyc');
    Route::post('updating-file-uploads', [LoanApplicationController::class, 'updateFiles'])->name('update-file-uploads');

    // ------- Loan Continue Completion
    
    Route::post('continue-loan', [LoanApplicationController::class, 'continue_loan'])->name('continue-loan');

});

Route::resource('posts', PostController::class);
Route::get('eligibility-score/{id}', EligibilityScoreView::class)->name('score');

// Site Pages
Route::get('faq', FaqPage::class)->name('faq');
Route::get('about-us', AboutPage::class)->name('about.us');
Route::get('our-team', TeamPage::class)->name('about.team');
Route::get('careers', CareerPage::class)->name('about.careers');
Route::get('contact-us', ContactPage::class)->name('contact');
Route::get('services', ServicePage::class)->name('services');
Route::post('request-for-loan', [LoanApplicationController::class, 'store'])->name('loan-request');

Route::get('get-application', [LoanApplicationController::class, 'getLoan'])->name('get-application');
Route::get('update-existing-application', [LoanApplicationController::class, 'updateExistingLoan'])->name('update-existing-application');

// Our Team
Route::get('vwanganji-bowa-ceo', PersonOne::class)->name('ceo');
Route::get('chiluba-bowa-coo', PersonTwo::class)->name('coo');
Route::get('lemmy-amatende-cfo', PersonThree::class)->name('cfo');
Route::get('chanda-mwenda-sales-and-marketing-director', PersonFour::class)->name('sales');


// Site Services Pages
Route::get('inventory-financing', PersonalLoan::class)->name('inventory');
Route::get('credit-facility', EducationalLoan::class)->name('credit');
Route::get('bridging-financing', AssetFinanceLoan::class)->name('bridging');
Route::get('equipment-financing', HomeLoan::class)->name('equipment');
Route::get('offer-trade-credit', SMELoan::class)->name('offer');
Route::get('refinancing', VehicleLoan::class)->name('refinancing');
Route::get('women-in-business-soft-loans', WIBLoan::class)->name('view-wib-loans');
Route::get('category/{category}', [PostController::class, 'category'])->name('posts.category');
Route::get('tag/{tag}', [PostController::class, 'tag'])->name('posts.tag');

// Alerts and Notifications
Route::get('successfully-applied-a-loan', SuccessPage::class)->name('success-application');
Route::get('email-sent-successfully', SuccessEmailPage::class)->name('success-email');


// Errors
Route::get('account-already-exists', AlreadyExistPage::class)->name('already-exists');