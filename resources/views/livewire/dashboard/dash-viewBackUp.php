<div class="content-body">
    <!-- Modal -->
    <div wire:ignore class="modal fade" id="exampleModal1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Seller Mobile Number</label>
                        <input type="number" class="form-control mb-3" id="exampleInputEmail1" placeholder="Number">
                        <label class="form-label">product Name</label>
                        <input type="email" class="form-control mb-3" id="exampleInputEmail2" placeholder=" Name">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control mb-3" id="exampleInputEmail3" placeholder="Amount">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="exampleModal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="bg-primary modal-header ">
                    <h5 class="modal-title text-white">Request Withdraw</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label">Payment method</label>
                        <div wire:ignore>
                            <select wire:model="payment_method" id="payment_method" class=" w-100 mb-3" aria-label="Default select example">
                                <option selected>--Choose--</option>
                                <option value="Mobile Money">Mobile Money</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                            </select>
                        </div>
                    </div>
                    
                    <label class="form-label">Amount</label>
                    <input wire:model.defer="withdraw_amount" type="text" class="form-control mb-3" id="amount" placeholder="ZMW">
                    
                    @if($payment_method === 'Mobile Money')
                        <label class="form-label">Mobile Number</label>
                        <input wire:model.defer="mobile_number" type="text" class="form-control mb-3" id="mobile_num" placeholder="Mobile Money Number">
                    @endif
                    @if($payment_method === 'Card')
                        <label class="form-label">Card Name</label>
                        <input wire:model.defer="card_name" type="text" class="form-control mb-3" id="card_name" placeholder="">
                        <label class="form-label">Bank Name</label>
                        <input wire:model.defer="bank_name" type="text" class="form-control mb-3" id="bank_name" placeholder="">
                        <label class="form-label">Card Number</label>
                        <input wire:model.defer="card_number" type="text" class="form-control mb-3" id="card_number" placeholder="">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button wire:loading.attr="disabled" wire:click="submitWithdrawRequest()" data-bs-dismiss="modal" id="withdraw-request-toastr-success-bottom-left" class="btn btn-primary">Submit Request</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore class="modal fade" id="exampleModal3" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title">Transfer Funds to Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Loan Application</label>
                    <select multiple class="default-select uppercase form-control wide mb-3" id="exampleInputEmail7" placeholder="Find Customer">
                        @forelse ($all_loan_requests as $item)
                        <option value="{{ $item->id }}">{{ $item->fname.' '.$item->lname.' | K'.$item->amount.' - '.$item->type.' Loan'.' | Duration '.$item->repayment_plan}}</option>
                        @empty
                        <option>No Customers Yet</option>
                        @endforelse
                    </select>
                    {{-- <label class="form-label">Expiry/Validity</label>
                    <input type="number" class="form-control mb-3" id="exampleInputEmail8" placeholder="Year/Month">
                    <label class="form-label">CVV</label>
                    <input type="number" class="form-control mb-3" id="exampleInputEmail9" placeholder="123"> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Proceed to Transfer</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore class="modal fade" id="exampleModal4" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title">Send Payment Remainders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Send email to</label>
                    <select multiple class="default-select uppercase form-control wide mb-3" id="exampleInputEmail7" placeholder="Find Customer">
                        @forelse ($all_loan_requests as $item)
                        <option value="{{ $item->email }}">{{ $item->fname.' '.$item->lname.' | K'.$item->amount.' - '.$item->type.' Loan'}}</option>
                        @empty
                        <option>No Customers Found</option>
                        @endforelse
                    </select>
                    <label class="form-label">Subject</label>
                    <input type="number" class="form-control mb-3" id="exampleInputEmail11" placeholder="Loan Payback Remainder">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Remaind Customer(s)</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('livewire.dashboard.__parts.loan-application') --}}
    <!-- row -->
    <div class="container-fluid pt-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="payment-bx">
                    <div class="d-flex py-2 justify-content-between flex-wrap">
                        @role('user')
                        <div class="payment-content">
                            <h3 class="font-w500 mb-2 text-white">Welcome to Bridgetrust Finance: Effortlessly Manage Your Loan Today!</h3>
                            @if($my_loan !== null)
                                @if ($my_loan->complete == 0)
                                <a href="{{ route('profile.show') }}" class="dz-para">We are glad to see you! Make sure your kyc profile is Complete </a>
                                @endif
                            @endif
                        </div>
                        @endrole
                        <div class="mb-4 mb-xl-0">
                            @can('make payments')
                            <!-- Button trigger modal -->
                            {{-- <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                Make a payment
                            </button> --}}
                            @endcan
                            @can('withdraw funds')
                            {{-- <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                Request Withdraw
                            </button> --}}
                            @endcan
                        </div>
                    </div>

                    {{-- @can('view financial overview') --}}
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card dz-wallet overflow-hidden">
                                <div class="boxs">
                                    <span class="box one"></span>
                                    <span class="box two"></span>
                                    <span class="box three"></span>
                                    <span class="box four"></span>
                                </div>
                                <div class="card-header border-0 pb-3 pb-sm-0 pe-4">
                                    <div class="wallet-icon">
                                        <svg width="62" height="39" viewBox="0 0 62 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="42.7722" cy="19.2278" r="19.2278" fill="white" fill-opacity="0.2" />
                                            <circle cx="19.2278" cy="19.2278" r="19.2278" fill="white" fill-opacity="0.2" />
                                        </svg>
                                    </div>
                                    @can('transfer funds to customers')
                                    {{-- <button type="button" class="modal-btn" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                        <span class="dz-wallet icon-box icon-box-lg m-auto mb-1 d-block">
                                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M15.1667 4.66667C15.1667 4.02233 14.6444 3.5 14 3.5C13.3557 3.5 12.8334 4.02233 12.8334 4.66667V18.6667C12.8334 19.311 13.3557 19.8333 14 19.8333C14.6444 19.8333 15.1667 19.311 15.1667 18.6667V4.66667Z" fill="white" />
                                                <path d="M7.825 12.4916C7.36939 12.9472 6.63069 12.9472 6.17508 12.4916C5.71947 12.036 5.71947 11.2973 6.17508 10.8417L13.1751 3.84171C13.6168 3.40003 14.3279 3.38458 14.7884 3.80665L21.7884 10.2233C22.2634 10.6587 22.2954 11.3967 21.8601 11.8717C21.4247 12.3467 20.6867 12.3787 20.2117 11.9433L14.0351 6.2815L7.825 12.4916Z" fill="white" />
                                                <path opacity="0.3" d="M23.3333 22.1667H4.66667C4.02233 22.1667 3.5 22.689 3.5 23.3334C3.5 23.9777 4.02233 24.5 4.66667 24.5H23.3333C23.9777 24.5 24.5 23.9777 24.5 23.3334C24.5 22.689 23.9777 22.1667 23.3333 22.1667Z" fill="white" />
                                            </svg>
                                        </span>
                                        <span>Transfer </span>
                                    </button> --}}
                                    @endcan
                                </div>
                                <div class="card-body py-3 pt-1 d-flex align-items-center justify-content-between flex-wrap pe-3">
                                    <div class="wallet-info">
                                        <span class="fs-14 font-w400 d-block">Wallet Balance</span>
                                        <h2 class="font-w600 mb-0">K {{ $wallet ?? '0.00' }}</h2>
                                    </div>

                                    @can('send payment remainders to customers')
                                    {{-- <button type="button" class="modal-btn" data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                        <span class="dz-wallet icon-box icon-box-lg ms-3 mb-1 d-block">
                                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M6.83329 2.33331H16.0258C16.4396 2.33331 16.84 2.47994 17.1559 2.74718L22.7134 7.44791C23.1066 7.78042 23.3333 8.26917 23.3333 8.78405V23.4305C23.3333 25.5195 23.3094 25.6666 21.1666 25.6666H6.83329C4.69048 25.6666 4.66663 25.5195 4.66663 23.4305V4.56942C4.66663 2.48046 4.69048 2.33331 6.83329 2.33331Z" fill="white" />
                                                <path d="M16.3333 12.8333H8.16667C7.52233 12.8333 7 13.3557 7 14C7 14.6443 7.52233 15.1667 8.16667 15.1667H16.3333C16.9777 15.1667 17.5 14.6443 17.5 14C17.5 13.3557 16.9777 12.8333 16.3333 12.8333Z" fill="white" />
                                                <path d="M11.6667 17.5H8.16667C7.52233 17.5 7 18.0223 7 18.6667C7 19.311 7.52233 19.8333 8.16667 19.8333H11.6667C12.311 19.8333 12.8333 19.311 12.8333 18.6667C12.8333 18.0223 12.311 17.5 11.6667 17.5Z" fill="white" />
                                            </svg>
                                        </span>
                                        <span>Send<br>Remainders</span>
                                    </button> --}}
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            @include('livewire.dashboard.__parts.dash-finanicial-stats')
                        </div>
                    </div>
                    {{-- @endcan --}}
                </div>

                @role('user')
                    @if($my_loan !== null)
                        @include('livewire.dashboard.__parts.dash-loan-reguest')
                    @else
                        <div class="items-center">
                            <h4>Apply for a Loan</h4>
                        </div>
                    {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyForLoanNow" id="applyForLoanNow">Apply For a Loan</button> --}}
                        @include('livewire.dashboard.__parts.loan-application-standalone')  
                    @endif
                @endrole

                {{-- <button type="button" class="btn btn-dark mb-2  me-2" id="toastr-success-bottom-left">Bottom Left</button> --}}
                @can('company overview dashboard')
                <div class="row">
                    <div class="col-xl-8">
                        @can('loan recoveries')
                        <div class="card crypto-chart h-auto">
                            <div class="card-header pb-0 border-0 flex-wrap">
                                <div>
                                    <div class="chart-title mb-3">
                                        <h2 class="heading">Loan Recoveries</h2>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="round weekly" id="dzOldSeries">
                                            <div>
                                                <input type="checkbox" id="checkbox1" name="radio" value="weekly">
                                                <label for="checkbox1" class="checkmark"></label>
                                            </div>
                                            <div>
                                                <span>This Month</span>
                                                <h4 class="mb-0">1.982</h4>
                                            </div>
                                        </div>
                                        <div class="round" id="dzNewSeries">
                                            <div>
                                                <input type="checkbox" id="checkbox" name="radio" value="monthly">
                                                <label for="checkbox" class="checkmark"></label>
                                            </div>
                                            <div>
                                                <span>This Week</span>
                                                <h4 class="mb-0">1.345</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-static">
                                    <div class="d-flex align-items-center mb-3 ">
                                        <select class="image-select default-select dashboard-select " id="box" aria-label="Default">
                                            <option value="month">This Month</option>
                                            <option value="week">This Weeks</option>
                                            <option value="today">Today</option>
                                        </select>

                                        {{-- <div class="dropdown custom-dropdown">
                                            <div class="btn sharp btn-primary tp-btn " data-bs-toggle="dropdown">
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.47908 4.58333C8.47908 3.19 9.60659 2.0625 10.9999 2.0625C12.3933 2.0625 13.5208 3.19 13.5208 4.58333C13.5208 5.97667 12.3933 7.10417 10.9999 7.10417C9.60658 7.10417 8.47908 5.97667 8.47908 4.58333ZM12.1458 4.58333C12.1458 3.95083 11.6324 3.4375 10.9999 3.4375C10.3674 3.4375 9.85408 3.95083 9.85408 4.58333C9.85408 5.21583 10.3674 5.72917 10.9999 5.72917C11.6324 5.72917 12.1458 5.21583 12.1458 4.58333Z" fill="#252289" />
                                                    <path d="M8.47908 17.4163C8.47908 16.023 9.60659 14.8955 10.9999 14.8955C12.3933 14.8955 13.5208 16.023 13.5208 17.4163C13.5208 18.8097 12.3933 19.9372 10.9999 19.9372C9.60658 19.9372 8.47908 18.8097 8.47908 17.4163ZM12.1458 17.4163C12.1458 16.7838 11.6324 16.2705 10.9999 16.2705C10.3674 16.2705 9.85408 16.7838 9.85408 17.4163C9.85408 18.0488 10.3674 18.5622 10.9999 18.5622C11.6324 18.5622 12.1458 18.0488 12.1458 17.4163Z" fill="#252289" />
                                                    <path d="M8.47908 11.0003C8.47908 9.60699 9.60659 8.47949 10.9999 8.47949C12.3933 8.47949 13.5208 9.60699 13.5208 11.0003C13.5208 12.3937 12.3933 13.5212 10.9999 13.5212C9.60658 13.5212 8.47908 12.3937 8.47908 11.0003ZM12.1458 11.0003C12.1458 10.3678 11.6324 9.85449 10.9999 9.85449C10.3674 9.85449 9.85408 10.3678 9.85408 11.0003C9.85408 11.6328 10.3674 12.1462 10.9999 12.1462C11.6324 12.1462 12.1458 11.6328 12.1458 11.0003Z" fill="#252289" />
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item active selected" href="javascript:void(0);">Option 1</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Option 2</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Option 3</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="progress-content">
                                        <div class="d-flex justify-content-between">
                                            <h6>Total</h6>
                                            <span class="pull-end">3.982</span>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-primary" style="width: 80%; height:	100%;" role="progressbar">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-2 custome-tooltip pb-0">
                                <div id="activity"></div>
                            </div>
                        </div>
                        @endcan
                        
                        @can('view loan requests')
                        <div class="card lastest_trans h-auto">
                            <div class="card-header dz-border flex-wrap pb-3">
                                <div>
                                    <h2 class="heading">Lastest 5 Requests</h2>
                                </div>
                                {{-- <div class="d-flex align-items-center">
                                    <select class="image-select default-select dashboard-select me-2 bg-white" aria-label="Default">
                                        <option selected>This Month</option>
                                        <option value="1">This Weeks</option>
                                        <option value="2">Today</option>
                                    </select>
                                    <div class="dropdown custom-dropdown">
                                        <div class="btn sharp btn-primary tp-btn mx-2" data-bs-toggle="dropdown">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.47908 4.58333C8.47908 3.19 9.60659 2.0625 10.9999 2.0625C12.3933 2.0625 13.5208 3.19 13.5208 4.58333C13.5208 5.97667 12.3933 7.10417 10.9999 7.10417C9.60658 7.10417 8.47908 5.97667 8.47908 4.58333ZM12.1458 4.58333C12.1458 3.95083 11.6324 3.4375 10.9999 3.4375C10.3674 3.4375 9.85408 3.95083 9.85408 4.58333C9.85408 5.21583 10.3674 5.72917 10.9999 5.72917C11.6324 5.72917 12.1458 5.21583 12.1458 4.58333Z" fill="#252289" />
                                                <path d="M8.47908 17.4163C8.47908 16.023 9.60659 14.8955 10.9999 14.8955C12.3933 14.8955 13.5208 16.023 13.5208 17.4163C13.5208 18.8097 12.3933 19.9372 10.9999 19.9372C9.60658 19.9372 8.47908 18.8097 8.47908 17.4163ZM12.1458 17.4163C12.1458 16.7838 11.6324 16.2705 10.9999 16.2705C10.3674 16.2705 9.85408 16.7838 9.85408 17.4163C9.85408 18.0488 10.3674 18.5622 10.9999 18.5622C11.6324 18.5622 12.1458 18.0488 12.1458 17.4163Z" fill="#252289" />
                                                <path d="M8.47908 11.0003C8.47908 9.60699 9.60659 8.47949 10.9999 8.47949C12.3933 8.47949 13.5208 9.60699 13.5208 11.0003C13.5208 12.3937 12.3933 13.5212 10.9999 13.5212C9.60658 13.5212 8.47908 12.3937 8.47908 11.0003ZM12.1458 11.0003C12.1458 10.3678 11.6324 9.85449 10.9999 9.85449C10.3674 9.85449 9.85408 10.3678 9.85408 11.0003C9.85408 11.6328 10.3674 12.1462 10.9999 12.1462C11.6324 12.1462 12.1458 11.6328 12.1458 11.0003Z" fill="#252289" />
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0);">Option 1</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Option 2</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Option 3</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-body p-0">
                                <!--list-->
                                <div class="table-responsive">
                                    <table class="table shadow-hover trans-table border-no dz-border tbl-btn short-one mb-0 ">
                                        <tbody>                                    
                                            @forelse($all_loan_requests as $loan)
                                            <tr class="trans-td-list">
                                                <td>
                                                    <div class="trans-list">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('public/images/trans/3.jpg') }}" class="avtar" alt="">
                                                        </div>
                                                        <div class="user-info">
                                                            <h6 class="font-w500 mb-0 ms-3">{{ $loan->fname.' '.$loan->lname }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-15 font-w500"> K {{ $loan->amount }}</span>
                                                </td>
                                                <td>
                                                    <span class="font-w400">{{ $loan->created_at->toFormattedDateString() }}</span>
                                                </td>
                                                <td class="pe-3">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {{-- <div class="icon-box btn-secondary light me-2">
                                                            <a href="javascript:void(0);">
                                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="#252289" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.7499 20.8538H8.24992C3.27242 20.8538 1.14575 18.7272 1.14575 13.7497V8.24967C1.14575 3.27217 3.27242 1.14551 8.24992 1.14551H13.7499C18.7274 1.14551 20.8541 3.27217 20.8541 8.24967V13.7497C20.8541 18.7272 18.7274 20.8538 13.7499 20.8538ZM8.24992 2.52051C4.02409 2.52051 2.52075 4.02384 2.52075 8.24967V13.7497C2.52075 17.9755 4.02409 19.4788 8.24992 19.4788H13.7499C17.9758 19.4788 19.4791 17.9755 19.4791 13.7497V8.24967C19.4791 4.02384 17.9758 2.52051 13.7499 2.52051H8.24992Z" fill="#252289" />
                                                                    <path d="M10.9999 13.9879C10.8257 13.9879 10.6516 13.9238 10.5141 13.7863L7.76407 11.0363C7.49824 10.7704 7.49824 10.3304 7.76407 10.0646C8.02991 9.79878 8.4699 9.79878 8.73574 10.0646L10.9999 12.3288L13.2641 10.0646C13.5299 9.79878 13.9699 9.79878 14.2357 10.0646C14.5016 10.3304 14.5016 10.7704 14.2357 11.0363L11.4857 13.7863C11.3482 13.9238 11.1741 13.9879 10.9999 13.9879Z" fill="#252289" />
                                                                    <path d="M11 13.9886C10.6242 13.9886 10.3125 13.6769 10.3125 13.3011V5.96777C10.3125 5.59194 10.6242 5.28027 11 5.28027C11.3758 5.28027 11.6875 5.59194 11.6875 5.96777V13.3011C11.6875 13.6861 11.3758 13.9886 11 13.9886Z" fill="#252289" />
                                                                    <path d="M11.0001 16.7107C9.0659 16.7107 7.12257 16.399 5.28007 15.7848C4.92257 15.6657 4.73007 15.2715 4.84924 14.914C4.96841 14.5565 5.3534 14.3548 5.72007 14.4832C9.13007 15.6198 12.8792 15.6198 16.2892 14.4832C16.6467 14.364 17.0409 14.5565 17.1601 14.914C17.2792 15.2715 17.0867 15.6657 16.7292 15.7848C14.8776 16.4082 12.9342 16.7107 11.0001 16.7107Z" fill="#252289" />
                                                                </svg>
                                                            </a>
                                                        </div> --}}
                                                        {{-- <div class="dropdown custom-dropdown">
                                                            <div class="btn sharp btn-secondary light icon-box  border-0 me-0 " data-bs-toggle="dropdown">
                                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.47908 4.58333C8.47908 3.19 9.60659 2.0625 10.9999 2.0625C12.3933 2.0625 13.5208 3.19 13.5208 4.58333C13.5208 5.97667 12.3933 7.10417 10.9999 7.10417C9.60658 7.10417 8.47908 5.97667 8.47908 4.58333ZM12.1458 4.58333C12.1458 3.95083 11.6324 3.4375 10.9999 3.4375C10.3674 3.4375 9.85408 3.95083 9.85408 4.58333C9.85408 5.21583 10.3674 5.72917 10.9999 5.72917C11.6324 5.72917 12.1458 5.21583 12.1458 4.58333Z" fill="#252289" />
                                                                    <path d="M8.47908 17.4163C8.47908 16.023 9.60659 14.8955 10.9999 14.8955C12.3933 14.8955 13.5208 16.023 13.5208 17.4163C13.5208 18.8097 12.3933 19.9372 10.9999 19.9372C9.60658 19.9372 8.47908 18.8097 8.47908 17.4163ZM12.1458 17.4163C12.1458 16.7838 11.6324 16.2705 10.9999 16.2705C10.3674 16.2705 9.85408 16.7838 9.85408 17.4163C9.85408 18.0488 10.3674 18.5622 10.9999 18.5622C11.6324 18.5622 12.1458 18.0488 12.1458 17.4163Z" fill="#252289" />
                                                                    <path d="M8.47908 11.0003C8.47908 9.60699 9.60659 8.47949 10.9999 8.47949C12.3933 8.47949 13.5208 9.60699 13.5208 11.0003C13.5208 12.3937 12.3933 13.5212 10.9999 13.5212C9.60658 13.5212 8.47908 12.3937 8.47908 11.0003ZM12.1458 11.0003C12.1458 10.3678 11.6324 9.85449 10.9999 9.85449C10.3674 9.85449 9.85408 10.3678 9.85408 11.0003C9.85408 11.6328 10.3674 12.1462 10.9999 12.1462C11.6324 12.1462 12.1458 11.6328 12.1458 11.0003Z" fill="#252289" />
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a wire:click="stall({{ $loan->id }})" class="dropdown-item" href="#">Stall</a>
                                                                <a wire:click="accept({{ $loan->id }})" class="dropdown-item" href="#">Accept Request</a>
                                                                <a wire:click="reject({{ $loan->id }})" class="dropdown-item" href="#">Reject Loan Request</a>
                                                                <a @disabled(true) disabled class="dropdown-item" href="#">View More Details</a>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <div>
                                                    No Loan Requests So Far.
                                                </div>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-pagenation pt-3 mt-0">
                                <a class="btn btn-xs btn-square btn-info" href="{{ route('view-loan-requests') }}">See more</a>
                                {{-- <p>Showing 1-5 from 100 data</p> --}}
                                {{-- <nav>
                                    <ul class="pagination pagination-gutter pagination-primary no-bg me-3">
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="javascript:void(0)">
                                                <i class="fa-solid fa-angle-left"></i></a>
                                        </li>
                                        <li class="page-item "><a class="page-link" href="javascript:void(0)">1</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="javascript:void(0)">
                                                <i class="fa-solid fa-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </nav> --}}
                            </div>
                        </div>
                        @endcan

                        @can('see the list of users')
                        <div wire:ignore class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="fs-20 font-w600 mb-0">Users</h4>
                                            {{-- <div class="dropdown custom-dropdown">
                                                <div class="btn sharp btn-primary tp-btn " data-bs-toggle="dropdown">
                                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.47908 4.58333C8.47908 3.19 9.60659 2.0625 10.9999 2.0625C12.3933 2.0625 13.5208 3.19 13.5208 4.58333C13.5208 5.97667 12.3933 7.10417 10.9999 7.10417C9.60658 7.10417 8.47908 5.97667 8.47908 4.58333ZM12.1458 4.58333C12.1458 3.95083 11.6324 3.4375 10.9999 3.4375C10.3674 3.4375 9.85408 3.95083 9.85408 4.58333C9.85408 5.21583 10.3674 5.72917 10.9999 5.72917C11.6324 5.72917 12.1458 5.21583 12.1458 4.58333Z" fill="#252289" />
                                                        <path d="M8.47908 17.4163C8.47908 16.023 9.60659 14.8955 10.9999 14.8955C12.3933 14.8955 13.5208 16.023 13.5208 17.4163C13.5208 18.8097 12.3933 19.9372 10.9999 19.9372C9.60658 19.9372 8.47908 18.8097 8.47908 17.4163ZM12.1458 17.4163C12.1458 16.7838 11.6324 16.2705 10.9999 16.2705C10.3674 16.2705 9.85408 16.7838 9.85408 17.4163C9.85408 18.0488 10.3674 18.5622 10.9999 18.5622C11.6324 18.5622 12.1458 18.0488 12.1458 17.4163Z" fill="#252289" />
                                                        <path d="M8.47908 11.0003C8.47908 9.60699 9.60659 8.47949 10.9999 8.47949C12.3933 8.47949 13.5208 9.60699 13.5208 11.0003C13.5208 12.3937 12.3933 13.5212 10.9999 13.5212C9.60658 13.5212 8.47908 12.3937 8.47908 11.0003ZM12.1458 11.0003C12.1458 10.3678 11.6324 9.85449 10.9999 9.85449C10.3674 9.85449 9.85408 10.3678 9.85408 11.0003C9.85408 11.6328 10.3674 12.1462 10.9999 12.1462C11.6324 12.1462 12.1458 11.6328 12.1458 11.0003Z" fill="#252289" />
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:void(0);">Option 1</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Option 2</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Option 3</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div id="pieChart1"></div>
                                        <div class="chart-labels">
                                            <ul class="d-flex align-items-baseline justify-content-between mt-3">
                                                <li>
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="7" fill="#D7D7D7" />
                                                    </svg><span class="font-w300">Guests</span>
                                                </li>
                                                <li>
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="7" fill="#9568ff" />
                                                    </svg>
                                                    <span class="font-w300">Registered Customers</span>
                                                </li>
                                                <li>
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="7" fill="#2696FD" />
                                                    </svg>
                                                    <span class="font-w300">Loan Officers</span>
                                                </li>
                                                <li>
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="7" fill="#252289" />
                                                    </svg>
                                                    <span class="font-w300">Blacklisted</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card bg-primary">
                                    <div class="card-body dz-date-picker">
                                        <div class="dz-calender">
                                            <input type="text" class="form-control d-none" id="datetimepicker" style="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endcan
                    </div>
                    @can('view company financial statistics')
                    <div class="col-xl-4">
                        <div class="card h-auto">
                            <div class="card-header border-0 pb-1 ">
                                <div>
                                    <h4 class="mb-0 fs-20 font-w600">Total Collected Repayments</h4>
                                </div>
                            </div>
                            <div class="card-body pb-0 pt-3 px-3 d-flex align-items-center flex-wrap">
                                <div id="pieChart2"></div>
                                <div class="weeklydata">
                                    <h6 class="mb-0 fs-14 font-w400">
                                    K {{ App\Models\Transaction::total_collected() }}
                                    </h6>
                                    {{-- <div class="d-flex align-items-center">
                                        <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.000488281" width="14" height="14" rx="3" fill="#d5dfe7" />
                                        </svg>
                                        <h6 class="mb-0 fs-14 font-w400">Unknown</h6>
                                        <span class="text-primary font-w700 ms-auto">10%</span>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div wire:ignore class="card-body pt-0 pb-0 px-3">
                                <div id="columnChart1" class="chartjs"></div>
                            </div> --}}

                        </div>
                            {{-- <div class="card h-auto">
                                <div class="card-body">
                                    <h4 class="fs-20 mb-0 mt-0">Notices Sent</h4>
                                    <span>Lorem ipsum dolor sit amet, consectetur</span>
                                    <div id="radialchart"></div>
                                    <h5 class="mb-0 fs-18 font-w500 text-center">On Progress <span class="text-primary fs-18 font-w500s">70%</span></h5>
                                </div>
                            </div> --}}
                        {{-- <div class="card contacts h-auto">
                            <div class="card-header border-0 pb-0">
                                <div>
                                    <h2 class="heading mb-0">Invoices Sent</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </div>

                            </div>
                            <div class="card-body loadmore-content  recent-activity-wrapper py-0 dz-scroll" id="RecentActivityContent">
                                <!--student-->
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic1.jpg" class=" avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Dedi Cahyadi</a></h6>
                                        <span class="fs-14 font-w400 text-wrap">Head Manager</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K776</span>
                                </div>
                                <!--/student-->
                                <!--student-->
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic2.jpg" class=" avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Evans John</a></h6>
                                        <span class=" text-wrap text-break">Programmer</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K777</span>

                                </div>
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic1.jpg" class=" avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Dedi Cahyadi</a></h6>
                                        <span class="fs-14 font-w400 text-wrap">Head Manager</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K778</span>
                                </div>
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic2.jpg" class=" avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Evans John</a></h6>
                                        <span class=" text-wrap text-break">Programmer</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K779</span>

                                </div>
                                <!--/student-->
                                <!--student-->
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic3.jpg" class="avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Brian Brandon</a></h6>
                                        <span>Graphic Designer</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K776</span>

                                </div>
                                <!--/student-->
                                <!--student-->
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic4.jpg" class="avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Bella Brownlee</a></h6>
                                        <span class=" text-wrap">Software Engineer</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K710</span>

                                </div>
                                <!--/student-->
                                <!--student-->
                                <div class="d-flex align-items-center student">
                                    <span class="dz-media">
                                        <img src="images/invoice-send-img/pic2.jpg" class="avtar avtar-lg" alt="">
                                    </span>
                                    <div class="user-info">
                                        <h6 class="name"><a href="app-profile.html">Evans John</a></h6>
                                        <span class=" text-wrap">Programmer</span>
                                    </div>
                                    <span class="text-primary ms-auto invoice-price">K711</span>

                                </div>
                                <!--/student-->

                            </div>
                            <div class="card-footer border-0 pt-3 px-3 px-sm-4">
                                <a hxref="contact.html" class="btn btn-block btn-primary  dz-load-more" id="RecentActivity" rel="ajax/recentactivity.html">VIEW MORE</a>
                            </div>
                        </div> --}}
                    </div>
                    @endcan
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>