

<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from tende.vercel.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:21:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tende</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/mfs/images/logoi.png')}}" />
    <!-- Custom Stylesheet -->
     
    <link rel="stylesheet" href="{{ asset('public/mfs/css/style.css')}}" />
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
            <!-- <div class="brand-logo">
                            <a href="index.html">
                                <img src="./images/logo.png" alt="">
                            </a>
                        </div> -->
            <div class="search">
              <form action="#">
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Search Here"
                  />
                  <span class="input-group-text"
                    ><i class="icofont-search"></i
                  ></span>
                </div>
              </form>
            </div>
          </div>

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
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon success"
                        ><i class="bi bi-check"></i
                      ></span>
                      <div>
                        <p>Account created successfully</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon fail"
                        ><i class="bi bi-x"></i
                      ></span>
                      <div>
                        <p>2FA verification failed</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon success"
                        ><i class="bi bi-check"></i
                      ></span>
                      <div>
                        <p>Device confirmation completed</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon pending"
                        ><i class="bi bi-exclamation-triangle"></i
                      ></span>
                      <div>
                        <p>Phone verification pending</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>

                  <a href="settings-activity.html"
                    >More <i class="icofont-simple-right"></i
                  ></a>
                </div>
              </div>
            </div>

            <div class="profile_log dropdown">
              <div class="user" data-toggle="dropdown">
                <span class="thumb"
                  ><img src="https://www.seekpng.com/png/detail/72-729756_how-to-add-a-new-user-to-your.png" alt=""
                /></span>
                <span class="arrow"><i class="icofont-angle-down"></i></span>
              </div>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="user-email">
                  <div class="user">
                    <span class="thumb"
                      ><img src="https://www.seekpng.com/png/detail/72-729756_how-to-add-a-new-user-to-your.png" alt=""
                    /></span>
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
                <a href="profile.html" class="dropdown-item">
                  <i class="bi bi-person"></i>Profile
                </a>
                {{-- <a href="{{ route('loan-wallet') }}" class="dropdown-item">
                  <i class="bi bi-wallet"></i>Wallet
                </a> --}}
                <a href="{{ route('profile.show') }}" class="dropdown-item">
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

<div class="sidebar">
    <div class="brand-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('public/web/images/logo.png')}}" alt="" width="50" /> 
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
            <span><i class="bi bi-house"></i></span>
            </a>
        </li>
        <li>
            <a
            href="{{ route('view-loan-requests') }}"
            data-toggle="tooltip"
            data-placement="right"
            title="My Loans"
            >
            <span><i class="bi bi-globe2"></i></span>
            </a>
        </li>
        <li>
            <a
            href="{{ route('loan-wallet') }}"
            data-toggle="tooltip"
            data-placement="right"
            title="My Wallet"
            >
            <span><i class="bi bi-wallet2"></i></span>
            </a>
        </li>
        <li>
            <a
            class="setting_"
            href="{{ route('profile.show') }}"
            data-toggle="tooltip"
            data-placement="right"
            title="Settings"
            >
            <span><i class="bi bi-gear"></i></span>
            </a>
        </li>
        <li class="logout">
            <a
            href="signin.html"
            data-toggle="tooltip"
            data-placement="right"
            title="Signout"
            >
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" class="dropdown-item ai-icon">
                    <span><i class="bi bi-power"></i></span>
                </button>
            </form>
            
            </a>
        </li>
        </ul>

        {{-- <p class="copyright">&#169; <a href="#">greenwebbtech</a></p> --}}
    </div>
</div>              


    {{$slot}}


</div>

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


</body>


<!-- Mirrored from tende.vercel.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:21:36 GMT -->
</html>
