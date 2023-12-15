<div class="content-body ">
    
    <div class="container ">
        <div class="row ">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="card home-chart fireworks">
                    <div class="card-header">
                        <h4 class="card-title home-chart">Loan Details</h4>
                        {{-- <select
                        class="form-select"
                        name="report-type"
                        id="report-select"
                        >
                        <option value="1">Bitcoin</option>
                        <option value="2">Litecoin</option>
                        </select> --}}
                    </div>
                    <div class="card-body">
                        <div class="home-chart-height">
                        <div class="row">
                            <div
                            class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                            >
                            <div class="chart-price-value">
                                <span>Loan</span>
                                <h5>{{ $loan->type }}</h5>
                            </div>
                            </div>
                            <div
                            class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                            >
                            <div class="chart-price-value">
                                <span>Borrowed</span>
                                <h5>{{ $loan->amount ?? 0 }} ZMW</h5>
                            </div>
                            </div>
                            <div
                            class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                            >
                            <div class="chart-price-value">
                                <span>Duration</span>
                                <h5>{{ $loan->repayment_plan }} Month(s)</h5>
                            </div>
                            </div>
                            <div
                            class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                            >
                            <div class="chart-price-value">
                                <span>Paying Back</span>
                                <h5>K {{ App\Models\Application::payback($loan->amount, $loan->repayment_plan) }}</h5>
                            </div>
                            </div>
                        </div>
                        <div id="chartx"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">Download App</h4>
                    </div>
                    <div class="card-body">
                    <div class="app-link">
                        <h5>Get Verified On Our Mobile App</h5>
                        <p>
                        Get mobile app more secure, faster,
                        and reliable.
                        </p>
                        <a href="#" class="btn btn-primary">
                        <img src="images/android.svg" alt="" />
                        </a>
                        <br />
                        <div class="mt-3"></div>
                        <a href="#" class="btn btn-primary">
                        <img src="images/apple.svg" alt="" />
                        </a>
                    </div>
                    </div>
                </div>  
            </div> --}}

            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">Information</h4>
                    {{-- <a href="settings-profile.html" class="btn btn-primary">Edit</a> --}}
                    </div>
                    <div class="card-body">
                    <form class="row">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="user-info">
                            <span>USER ID</span>
                            <h4>{{ $loan->user->id }}</h4>
                        </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="user-info">
                            <span>EMAIL ADDRESS</span>
                            <h4>{{ $loan->user->email ?? 'Not set'}}</h4>
                        </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="user-info">
                            <span>RESIDENCIAL ADDRESS</span>
                            <h4>{{ $loan->user->address ?? 'Not set'}}</h4>
                        </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="user-info">
                            <span>JOINED SINCE</span>
                            <h4>{{ $loan->user->created_at->toFormattedDateString()}}</h4>
                        </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="user-info">
                            <span>TYPE</span>
                            <h4>{{ $loan->type }}</h4>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-xxl-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">VERIFY & UPGRADE</h4>
                    </div>
                    <div class="card-body">
                    <h5>
                        Loan Status :
                        @if ($loan->status == 0)
                            @if($loan->complete == 0)
                                <span class="text-warning">
                                    Incomplete KYC <i class="icofont-warning"></i>
                                </span>
                            @else
                                <span class="text-warning">
                                    Pending <i class="icofont-warning"></i>
                                </span>
                            @endif
                        @else
                            @if($loan->complete == 0)
                                <span class="text-warning">
                                    Incomplete KYC <i class="icofont-warning"></i>
                                </span>
                            @else
                                <span class="text-warning">
                                    Pending <i class="icofont-warning"></i>
                                </span>
                            @endif
                        @endif
                        @if ($loan->status == 1)
                            <span class="text-success">
                                Accepted <i class="icofont-success"></i>
                            </span>
                        @endif
                        @if ($loan->status == 2)
                            <span class="text-success">
                                Under Review <i class="icofont-info"></i>
                            </span>
                        @endif
                        @if ($loan->status == 3)
                            <span class="text-success">
                                Rejected <i class="icofont-default"></i>
                            </span>
                        @endif
                    
                    </h5>


                    {{-- Message --}}
                    
                    @if ($loan->status == 0)
                    <p>
                        @if($loan->complete == 0)
                        Your loan request needs attention. Please update your profile information within the next 24 hours to avoid potential delays or denial of your application.
                        @else
                            Your loan request is unverified. Please hold on while we process your request
                        @endif
                    </p>
                    <a href="{{ route('profile.show') }}" class="btn btn-warning"> Update Profile</a>
                    @endif
                    @if ($loan->status == 1)
                    <p>
                        Great news! Your loan request has been accepted. Congratulations!
                    </p>
                    <a href="#" class="btn btn-primary"> Get Cash</a>
                    @endif
                    @if ($loan->status == 2)
                    <p>
                        Your loan request is currently under review. We appreciate your patience and will notify you via email of any updates.
                    </p>
                    {{-- <a href="#" class="btn btn-primary"> Get Verified</a> --}}
                    @endif
                    @if ($loan->status == 3)
                    <p>
                        Loan request rejected. Feel free to reapply later. For assistance, contact customer support.
                    </p>
                    <a href="#" class="btn btn-primary"> Reapply</a>
                    @endif
                    
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">Earn 30% Commission</h4>
                    </div>
                    <div class="card-body">
                    <p>Refer your friends and earn 30% of their trading fees.</p>
                    <a @disabled(true) href="#" class="btn btn-primary"> Referral Program</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

