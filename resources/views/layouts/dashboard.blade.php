<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Mighty Finance Solution</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/theme/images/favicon.png') }}">
    <link href="{{ asset('public/theme/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/theme/vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('public/theme/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/theme/css/style.css') }}" rel="stylesheet">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/theme/vendor/nouislider/nouislider.min.css') }}">
	<link href="{{ asset('public/theme/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ asset('public/theme/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/theme/vendor/jquery-steps/css/jquery.steps.css') }}" rel="stylesheet">
	@livewireStyles
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> --}}
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <img style="width: 50%" src="{{ asset('public/web/images/logo.png') }}" alt="">
                {{-- <img class="logo-compact" src="{{ asset('public/web/images/logo-text.png') }}" alt=""> --}}
                {{-- <img class="brand-title" src="{{ asset('public/web/images/logo-text.png') }}" alt=""> --}}
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		<div class="chatbox">
			<div class="chatbox-close"></div>
			<div class="custom-tab-1">
				<ul class="nav nav-tabs">
					{{-- <li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#notes">Notes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#alerts">Alerts</a>
					</li> --}}
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#chat">Notifications</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="chat" role="tabpanel">
						<div class="card mb-sm-3 mb-md-0 contacts_card dz-chat-user-box">
							
							<div class="card-body contacts_body p-0 dz-scroll " id="DZ_W_Contacts_Body">
								<ul class="contacts">
									<li class="name-first-letter">Latest</li>
                                    @forelse (auth()->user()->unreadNotifications as $item)
									<li class="active dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                                </svg>
												{{-- <img src="images/avatar/1.jpg" class="rounded-circle user_img" alt=""/>
												<span class="online_icon"></span> --}}
											</div>
											<div class="user_info">
												<span>{{ $item->data['name'] }}</span>
												<small>{{ $item->data['msg'] }}</small>
											</div>
										</div>
									</li>
									@empty
                                    <li>
                                        <p>No notifications.</p>
                                    </li>
                                    @endforelse
								</ul>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
        <div class="header" style="background: #2f0238; color:#fff">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="text-white dashboard_bar">
                                Dashboard
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell bell-link" href="#">
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M20.4604 0.848877H3.31682C2.64742 0.849612 2.00565 1.11586 1.53231 1.58919C1.05897 2.06253 0.792727 2.7043 0.791992 3.3737V15.1562C0.792727 15.8256 1.05897 16.4674 1.53231 16.9407C2.00565 17.4141 2.64742 17.6803 3.31682 17.6811C3.53999 17.6812 3.75398 17.7699 3.91178 17.9277C4.06958 18.0855 4.15829 18.2995 4.15843 18.5227V20.3168C4.15843 20.6215 4.24112 20.9204 4.39768 21.1818C4.55423 21.4431 4.77879 21.6571 5.04741 21.8009C5.31602 21.9446 5.61861 22.0128 5.92292 21.9981C6.22723 21.9834 6.52183 21.8863 6.77533 21.7173L12.6173 17.8224C12.7554 17.7299 12.9179 17.6807 13.0841 17.6811H17.187C17.7383 17.68 18.2742 17.4994 18.7136 17.1664C19.1531 16.8335 19.472 16.3664 19.6222 15.8359L22.8965 4.05011C22.9998 3.67481 23.0152 3.28074 22.9413 2.89856C22.8674 2.51637 22.7064 2.15639 22.4707 1.84663C22.2349 1.53687 21.9309 1.28568 21.5822 1.11263C21.2336 0.939571 20.8497 0.849312 20.4604 0.848877ZM21.2732 3.60304L18.0005 15.3847C17.9499 15.5614 17.8432 15.7168 17.6964 15.8275C17.5496 15.9381 17.3708 15.9979 17.187 15.9978H13.0841C12.5855 15.9972 12.098 16.1448 11.6836 16.4219L5.84165 20.3168V18.5227C5.84091 17.8533 5.57467 17.2115 5.10133 16.7382C4.62799 16.2648 3.98622 15.9986 3.31682 15.9978C3.09365 15.9977 2.87966 15.909 2.72186 15.7512C2.56406 15.5934 2.47534 15.3794 2.47521 15.1562V3.3737C2.47534 3.15054 2.56406 2.93655 2.72186 2.77874C2.87966 2.62094 3.09365 2.53223 3.31682 2.5321H20.4604C20.5905 2.53243 20.7187 2.56277 20.8352 2.62076C20.9516 2.67875 21.0531 2.76283 21.1318 2.86646C21.2104 2.97008 21.2641 3.09045 21.2886 3.21821C21.3132 3.34597 21.3079 3.47766 21.2732 3.60304Z" fill="#6418C3"/>
										<path d="M5.84161 8.42333H10.0497C10.2729 8.42333 10.4869 8.33466 10.6448 8.17683C10.8026 8.019 10.8913 7.80493 10.8913 7.58172C10.8913 7.35851 10.8026 7.14445 10.6448 6.98661C10.4869 6.82878 10.2729 6.74011 10.0497 6.74011H5.84161C5.6184 6.74011 5.40433 6.82878 5.2465 6.98661C5.08867 7.14445 5 7.35851 5 7.58172C5 7.80493 5.08867 8.019 5.2465 8.17683C5.40433 8.33466 5.6184 8.42333 5.84161 8.42333Z" fill="#6418C3"/>
										<path d="M13.4161 10.1066H5.84161C5.6184 10.1066 5.40433 10.1952 5.2465 10.3531C5.08867 10.5109 5 10.725 5 10.9482C5 11.1714 5.08867 11.3855 5.2465 11.5433C5.40433 11.7011 5.6184 11.7898 5.84161 11.7898H13.4161C13.6393 11.7898 13.8534 11.7011 14.0112 11.5433C14.169 11.3855 14.2577 11.1714 14.2577 10.9482C14.2577 10.725 14.169 10.5109 14.0112 10.3531C13.8534 10.1952 13.6393 10.1066 13.4161 10.1066Z" fill="#6418C3"/>
									</svg>
									<span class="badge light text-white bg-primary">{{ auth()->user()->unreadNotifications->count() }}</span>
                                </a>
							</li>
							
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link text-white" href="#" role="button" data-toggle="dropdown">
									<div class="header-info">
										<span class="text-white">Hello, <strong>{{ auth()->user()->fname.' '.auth()->user()->lname ?? auth()->user()->name }}</strong></span>
										<p class="fs-12 mb-0">{{ preg_replace('/[^A-Za-z0-9. -]/', '',  Auth::user()->roles->pluck('name')) ?? 'Guest' }}</p>
									</div>                                        
                                    @if(auth()->user()->profile_photo_path == null)
									<div class="p-3 rounded-full">
										@if(auth()->user()->fname != null && auth()->user()->lname != null)
											<span class="text-primary">{{ auth()->user()->fname[0].' '.auth()->user()->lname[0] }}</span>
										@else   
											<span class="text-primary">{{ auth()->user()->name[0] }}</span>
										@endif
									</div>
                                    @else
                                    <img width="20" src="{{ 'public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile.show') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="{{ route('notifications') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Notifications </span>
                                    </a>
									<form method="POST" action="{{ route('logout') }}" x-data>
										@csrf
										<button type="submit" class="dropdown-item ai-icon">
											<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
											<span class="ml-2">Logout </span>
										</button>
									</form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li>
                        <a class="" href="{{ route('dashboard') }}" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
                    @can('view clientele')
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">Manage Clientele</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('borrowers') }}">View Borrowers</a></li>
                            <li><a href="{{ route('notify-borrowers') }}">Send Emails to Borrowers</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('view loans')
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-notepad"></i>
                            @role('user')
                            <span class="nav-text">My Loan</span>
                            @else
                            <span class="nav-text">Manage Loans</span>
                            @endrole
						</a>
                        <ul aria-expanded="false">
                            @can('view loan requests')
                                @role('user')
                                <li><a href="{{ route('new-loan') }}">New Loan</a></li>
                                @else
                                <li><a href="{{ route('proxy-loan-create') }}">New Loan</a></li>
                                @endrole
                            @endcan
                            @can('view loan requests')
                            <li><a href="{{ route('view-loan-requests') }}">View Loans</a></li>
                            @endcan
                            {{-- @hasanyrole(['admin', 'employee']) --}}
                            <li><a href="{{ route('repayments') }}">Pending Repayments</a></li>
                            <li><a href="{{ route('closed-loans') }}">Closed Loans</a></li>
                            {{-- <li><a href="{{ route('view-loan-rates') }}">Loan Rates</a></li> --}}
                            {{-- @endhasanyrole --}}
                            <li><a href="{{ route('missed-repayments') }}">Missed Repayments</a></li>
                            <li><a href="{{ route('past-maturity-date') }}">Past Maturity Date</a></li>
                            @can('view loan relatives')
                            <li><a href="{{ route('guarantors') }}">Guarantors</a></li>
                            @endcan
                            @can('view loan calculator')
                            <li><a href="{{ route('view-repayment-calculator') }}">Loan Calculator</a></li>
                            @endcan 
                            @role('user')
                            {{-- <li><a href="{{ route('withdraw-requests') }}">Withdraw Requests</a></li> --}}
                            @endrole
                        </ul>
                    </li>
                    @endcan
                    @can('view employees')
                    <li><a class="" href="{{ route('employees') }}" aria-expanded="false">
							<i class="flaticon-381-network"></i>
							<span class="nav-text">Employees</span>
						</a>
                    </li>
                    @endcan
                    @can('view accounting')
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">Accounting</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('make-payment') }}">Payment Transactions</a></li>
                            <li><a href="{{ route('loan-wallet') }}">Manage Funds</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('view reports')
                    <li><a class="" href="{{ route('loan-report') }}" aria-expanded="false">
							<i class="flaticon-381-network"></i>
							<span class="nav-text">Reports</span>
						</a>
                    </li>
                    @endcan
                    @can('view system settings')
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">CMS Manager</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('contact-settings') }}">Contact Details</a></li> 
                            <li><a href="{{ route('careers-settings') }}">Careers</a></li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            
				{{-- <div class="add-menu-sidebar">
					<p>Generate Monthly Credit Report</p>
					<a href="javascript:void(0);">
					<svg width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M23.725 5.14889C23.7248 5.14861 23.7245 5.14828 23.7242 5.148L18.8256 0.272997C18.4586 -0.0922062 17.865 -0.0908471 17.4997 0.276184C17.1345 0.643169 17.1359 1.23675 17.5028 1.602L20.7918 4.875H0.9375C0.419719 4.875 0 5.29472 0 5.8125C0 6.33028 0.419719 6.75 0.9375 6.75H20.7917L17.5029 10.023C17.1359 10.3882 17.1345 10.9818 17.4998 11.3488C17.865 11.7159 18.4587 11.7172 18.8256 11.352L23.7242 6.477C23.7245 6.47672 23.7248 6.47639 23.7251 6.47611C24.0923 6.10964 24.0911 5.51414 23.725 5.14889Z" fill="white"/>
					</svg>
					</a>
				</div> --}}
				<div class="copyright">
					<p><strong>Mighty Finance </strong> © 2022 All Rights Reserved</p>
					<p>Made with <i class="fa fa-heart"></i> by <a style="color:rgb(29, 26, 26);" href="http://greenwebbtech.com"><t style="color:green;">Green</t>webb</t></a></p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        {{ $slot }}
        <!--**********************************
            Content body end
        ***********************************-->

		@stack('modals')

		@livewireScripts

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://greenwebbtech.com" target="_blank"><span style="color:green">Green</span>webb</a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
   
    <!-- Required vendors -->
    <script src="{{ asset('public/theme/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('public/theme/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('public/theme/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('public/theme/js/custom.min.js') }}"></script>
	<script src="{{ asset('public/theme/js/deznav-init.js') }}"></script>
	<script src="{{ asset('public/theme/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/peity/jquery.peity.min.js') }}"></script>
	<script src="{{ asset('public/theme/js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/theme/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/theme/js/plugins-init/jquery.validate-init.js') }}"></script>
    <script src="{{ asset('public/theme/js/plugins-init/jquery-steps-init.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>	
	<script src="{{ asset('public/theme/js/dashboard/my-wallet.js') }}"></script>

    <script>
		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			/*  testimonial one function by = owl.carousel.js */
			jQuery('.owl-bank-wallet').owlCarousel({
				loop:true,
				autoplay:false,
				margin:0,
				nav:false,
				center:true,
				dots: false,
				navText: [''],
				responsive:{
					0:{
						items:2
					},
					
					480:{
						items:2
					},			
					
					991:{
						items:3
					},
					1200:{
						items:3
					},
					1600:{
						items:2
					}
				}
			})		
			
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:true,
				dots: false,
				center:true,
				navText: ['', '<i class="las la-long-arrow-alt-right"></i>'],
				responsive:{
					0:{
						items:3
					},
					600:{
						items:5
					},	
					991:{
						items:8
					},			
					
					1200:{
						items:8
					},
					1600:{
						items:6
					}
				}
			})			
		}
		
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});
	</script>
</body>
</html>