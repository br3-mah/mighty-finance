

<!DOCTYPE html>
<html lang="en">
  @php
    // Gobal Variables
    $meta = App\Models\User::meta();
    $activeLoan = App\Models\Application::currentApplication();
    $status = App\Models\Application::currentApplication()->continue;
    $kyc = App\Models\Application::currentApplication()->complete;
    $route = request()->route()->getName();
    
  @endphp
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mighty Finance Solution | App</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/web/images/favicon.png') }}" />
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/mfs/css/style.css')}}" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://unpkg.com/intro.js/introjs.css">
    <!-- Include your modal library (e.g., Bootstrap) -->
    <!-- Add your modal CSS and JS here -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    @livewireStyles
    <style>
        .p-6{
          padding: 3%;
        }
      .text-center{
          text-align: center;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: rgba(0, 0, 0, 0.317); Dimmed background */
            backdrop-filter: blur(2px); /* Blurred background */
            z-index: 1;
        }

        /* Styling for the modal */
        #continue-loan-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.105); /* Dimmed background */
            backdrop-filter: blur(5px); /* Blurred background */
            padding: 20px;
            z-index: 2;
        }

        /* Optional: Style for the close button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        #sendDocModal {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* semi-transparent background overlay */
        }

        .send-doc-modal {
            max-width: 600px; 
            z-index: 1050; 
        }

        /* Default styles for the "hideInMobile" div */
  

        /* Media query to hide the "hideInMobile" div on screens smaller than 768 pixels */
        @media (max-width: 768px) {
          #hideInMobile {
            display: none;
          }
        }
    </style>
    
    <script src="https://jsuites.net/v4/jsuites.js"></script>
  </head>

  <body class="dashboard">

    <div id="preloader"><i>.</i><i>.</i><i>.</i></div>


    <div id="main-wrapper">
      <div class="header bg-light">
      <div class="container">
        <div class="row">
          <div class="col-xxl-12">
            <div class="header-content">
              <div class="header-left">
                {{-- <div class="brand-logo">
                                <a href="index.html">
                                    <img src="./images/logo.png" alt="">
                                </a>
                            </div>  --}}
                <div class="search">
                  <form action="#">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Loan ID"
                        style="bo"
                      />
                      <span style="background:linear-gradient(to right, #662d91, #912d73);" class="input-group-text"
                        ><i class="icofont-search text-white"></i
                      ></span>
                    </div>
                  </form>
                </div>
                

              </div>

              {{-- <div id="hideInMobile" class="header-right">
                <div class="notify-bell">
                  <span class="btn" style="background: #662d91"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                    <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
                  </svg> Transfer</span>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="notify-bell">
                  <span class="btn text-primary" style="background: #662d912f"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-safe" viewBox="0 0 16 16">
                    <path d="M1 1.5A1.5 1.5 0 0 1 2.5 0h12A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 1 14.5V13H.5a.5.5 0 0 1 0-1H1V8.5H.5a.5.5 0 0 1 0-1H1V4H.5a.5.5 0 0 1 0-1H1zM2.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5z"/>
                    <path d="M13.5 6a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5M4.828 4.464a.5.5 0 0 1 .708 0l1.09 1.09a3.003 3.003 0 0 1 3.476 0l1.09-1.09a.5.5 0 1 1 .707.708l-1.09 1.09c.74 1.037.74 2.44 0 3.476l1.09 1.09a.5.5 0 1 1-.707.708l-1.09-1.09a3.002 3.002 0 0 1-3.476 0l-1.09 1.09a.5.5 0 1 1-.708-.708l1.09-1.09a3.003 3.003 0 0 1 0-3.476l-1.09-1.09a.5.5 0 0 1 0-.708zM6.95 6.586a2 2 0 1 0 2.828 2.828A2 2 0 0 0 6.95 6.586"/>
                  </svg> Fund Account</span>
                </div>
              </div> --}}
              <div class="header-right">
                <div class="dark-light-toggle" onclick="themeToggle()">
                  <span class="dark"><i class="bi bi-moon"></i></span>
                  <span class="light"><i class="bi bi-brightness-high"></i></span>
                </div>
                <div class="notification dropdown">
                  <div class="notify-bell" data-toggle="dropdown">
                    <span><i class="bi bi-bell"></i></span>
                  </div>
                  <div class="dropdown-menu dropdown-menu-right notification-list">
                    <h4>Announcements</h4>
                    <div class="lists">
                      
                      @forelse (auth()->user()->unreadNotifications as $item)
                      <a href="#" class="">
                        <div class="d-flex align-items-center">
                          <span class="me-3 icon success"
                            ><i class="bi bi-check"></i
                          ></span>
                          <div>
                            <p>{{ $item->data['name'] }}</p>
                            <span>{{ $item->data['msg'] }}</span>
                            {{-- <span>2020-11-04 12:00:23</span> --}}
                          </div>
                        </div>
                      </a>
                      @empty
                      @endforelse
                      <a href="{{ route('notifications') }}"
                        >More <i class="icofont-simple-right"></i
                      ></a>
                    </div>
                  </div>
                </div>

                <div class="profile_log dropdown">
                  <div class="user" data-toggle="dropdown">
                    <span class="thumb"
                      >
                    @if (auth()->user()->profile_photo_path)
                      @if ($route == 'profile.show' || $route == 'loan-details' || $route == 'loan-statement')
                        <img width="100" style="border-radius:50%" src="{{ '../public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="">
                      @else
                        <img width="100" style="border-radius:50%" src="{{ 'public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="">
                      @endif
                    @else
                      <img width="100" style="border-radius:50%" src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt=""
                    @endif
                    />
                  
                  </span>
                    <span class="arrow"><i class="icofont-angle-down"></i></span>
                  </div>
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="user-email">
                      <div class="user">
                        <span class="thumb">
                          
                          @if (auth()->user()->profile_photo_path)
                            @if ($route == 'profile.show' || $route == 'loan-details' || $route == 'loan-statement')
                            <img style="border-radius:50%" src="{{ '../public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt=""/>
                            @else
                            <img style="border-radius:50%" src="{{ 'public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt=""/>
                            @endif
                          @else
                            <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt=""/>
                          @endif
                          
                        </span>
                        <div class="user-info">
                          <h5>{{ auth()->user()->fname.' '.auth()->user()->lname }}</h5>
                          <span>{{ auth()->user()->email }}</span>
                        </div>
                      </div>
                    </div>

                    <div class="user-balance">
                      <div class="available">
                        <p>Available</p>
                        <span>0.00 ZMW</span>
                      </div>
                      <div class="total">
                        <p>Total</p>
                        <span>0.00 ZMW</span>
                      </div>
                    </div>
                    <a href="{{ route('my-profile', ['view' => 'profile']) }}" class="dropdown-item">
                      <i class="bi bi-person"></i>Profile
                    </a>
                    <a href="{{ route('payments') }}" class="dropdown-item">
                      <i class="bi bi-wallet"></i>Payments
                    </a>
                    <a href="{{ route('settings') }}" class="dropdown-item">
                      <i class="bi bi-gear"></i> Setting
                    </a>
                    {{-- <a href="settings-activity.html" class="dropdown-item">
                      <i class="bi bi-clock-history"></i> Activity
                    </a> --}}
                    {{-- <a href="lock.html" class="dropdown-item">
                      <i class="bi bi-lock"></i>Lock
                    </a> --}}
                    <a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item ">
                                <span><i class="bi bi-power"></i></span> Sign Out
                            </button>
                        </form>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="sidebar" style="background-image: linear-gradient(to right, #662d91, #662d91); color:#fff;" >
        <div class="brand-logo">
            <a href="{{ route('dashboard') }}" style="margin:4%;">
                <img src="{{ asset('public/web/images/01-ft-logo.png')}}" alt="" width="80" /> 
            </a>
        </div>
        <div class="menu">
            <ul>
              <li>
                  <a
                  href="{{ route('dashboard') }}"
                  data-toggle="tooltip"
                  data-placement="right"
                  title="Dashboard"
                  >
                  <span class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                      <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                  </span>
                  </a>
              </li>
              <li>
                  <a
                  href="{{ route('view-loan-requests') }}"
                  data-toggle="tooltip"
                  data-placement="right"
                  title="My Loans"
                  >
                  <span class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                      <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                      <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/>
                    </svg>
                  </span>
                  </a>
              </li>
              <li>
                  <a
                  href="{{ route('loan-wallet') }}"
                  data-toggle="tooltip"
                  data-placement="right"
                  title="My Wallet"
                  >
                  <span><i class="bi bi-wallet2 text-white"></i></span>
                  </a>
              </li>
              <li>
                  <a
                  class="setting_"
                  href="{{ route('settings') }}"
                  data-toggle="tooltip"
                  data-placement="right"
                  title="Settings"
                  >
                  <span><i class="bi bi-gear text-white"></i></span>
                  </a>
              </li>
              <li class="logout">
                  <a
                  data-toggle="tooltip"
                  data-placement="right"
                  title="Signout"
                  >
                  <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <button type="submit" class="dropdown-item ai-icon">
                          <span><i class="bi bi-power text-white"></i></span>
                      </button>
                  </form>
                  
                  </a>
              </li>
            </ul>

            {{-- <p class="copyright">&#169; <a href="#">greenwebbtech</a></p> --}}
        </div>
    </div>   
    
    {{$slot}}
    
    @include('components.continue-application')
    @include('components.email-docs')
  </div>
  @stack('modals')

  @livewireScripts
  <script src="{{ asset('public/mfs/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('public/mfs/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{ asset('public/mfs/vendor/apexchart/apexcharts.min.js')}}"></script>
  <script src="{{ asset('public/mfs/js/plugins/apex-price.js')}}"></script>

  <script src="{{ asset('public/mfs/vendor/basic-table/jquery.basictable.min.js')}}"></script>
  <script src="{{ asset('public/mfs/js/plugins/basic-table-init.js')}}"></script>

  <script src="{{ asset('public/mfs/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('public/mfs/js/plugins/perfect-scrollbar-init.js')}}"></script>

  <script src="{{ asset('public/mfs/js/dashboard.js')}}"></script>
  <script src="{{ asset('public/mfs/js/scripts.js')}}"></script>

  {{-- Third party --}}
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

  <script>
    AOS.init();
    let status = '{{ $status }}';
    let router = '{{ $route }}';
    let kyc = '{{$kyc}}';

    $('#sendDocModal').hide();
    $('#sendDocResponseText').hide();
    $('#sendDocResponseText2').hide();
    
    if(status === '1'){
      $(document).ready(function() {
          // Show overlay and modal when the page loads
          $("#overlay, #continue-loan-modal").show();
      });

      function closeModal() {
          // Hide overlay and modal when the close button is clicked
          $("#overlay, #continue-loan-modal").hide();
      }
    }

    function openSendDocModal() {
        $('#sendDocModal').show();
    }
    function closeSendDocModal() {
        $('#sendDocModal').hide();
    }
    function shareDocuments() {
        // Disable the button and show the loading spinner
        $('#cancelShareDoc').hide();
        $('#shareButton').prop('disabled', true);
        $('#shareButtonText').hide();
        $('#shareButtonSpinner').removeClass('d-none');

        var formData = $('#shareDocsForm').serialize();
        var route = "{{ route('share.docs')}}"
        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            success: function(response) {
                // Enable the button and hide the loading spinner
                $('#shareButton').prop('disabled', false);
                $('#shareButtonText').show();
                $('#shareButtonSpinner').addClass('d-none');
                $('#cancelShareDoc').show();
                closeSendDocModal();
                if(response.msg){
                  $('#sendDocResponseText').show();
                }else{
                  $('#sendDocResponseText2').show();
                }
            },
            error: function(error) {
                // Handle error, if needed
                console.log(error);
            },
            complete: function() {
                // Enable the button and hide the loading spinner
                $('#shareButton').prop('disabled', false);
                $('#shareButtonText').show();
                $('#shareButtonSpinner').addClass('d-none');
            }
        });
    }
  </script>

{{-- Loan Completion Form was here --}}

<script src="https://unpkg.com/intro.js/intro.js"></script>
<script>
// Get the current URL
var currentUrl = window.location.href;

// Extract the route name from the URL
var route = currentUrl.split('/').pop();

// Check if the route starts with "dashboard"
// if (route.startsWith('dashboard') && kyc === '0' ) {
//     // alert('Current route starts with "dashboard"');
//     introJs().setOptions({
//         steps: [{
//             element: document.querySelector('.tour-kyc-1'),
//             intro: "Click here to complete your KYC profile information!",
//             position: 'left'
//         }]
//     }).start();
//     introJs().addHints();
// } else {
//     // alert('Current route does not start with "dashboard"');
// }
</script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
  // let table = new DataTable('#default_loan_list', {
  //     responsive: true
  // });
  $(document).ready( function () {
      $('#default_loan_list').DataTable();
  });
</script>
</body>


<!-- Mirrored from tende.vercel.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:21:36 GMT -->
</html>
