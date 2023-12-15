

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from tende.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:21:43 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mighty Finance Solution | Sign In</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/web/images/favicon.png') }}" />
    <!-- Custom Stylesheet -->
    <link href="{{ asset('public/theme/css/style.css') }}" rel="stylesheet">
    <style>

      a{
            color: rgb(255, 187, 0);
        }
    </style>
</head>

<body class="@@dashboard" style="margin: 0; overflow: hidden;">
 <div id="preloader"><i>.</i><i>.</i><i>.</i></div>
 <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(102, 45, 145, 0.947), rgba(145, 45, 115, 0.893)), url('https://cdn03.allafrica.com/download/pic/main/main/csiid/00611742:63e77387f56223a1509fb944791b01eb:arc614x376:w735:us1.jpg'); background-size: cover; background-position: center;"></div>
  <div id="main-wrapper" >
    <div class="authincation section-padding">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-xl-5 col-md-6">
            <div class="mini-logo text-center my-4">
              <a href="{{ route('welcome') }}">
                  <img width="120" src="{{ asset("/public/web/images/01-ft-logo.png") }}" alt="" />
              </a>
              <h4 class="card-title text-white mt-5">Sign in</h4>
            </div>
            <div class="auth-form card " style="box-shadow: rgba(255, 255, 255, 0.219) 0px 5px 15px 0px;">
              
              <x-jet-validation-errors class="alert text-center alert-danger text-danger text-xs" />
              <div class="">
                <form
                  name="myform"
                  class=" row g-3" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="col-12">
                      <input
                          type="email" name="email" :value="old('email')"
                          class="form-control"
                          placeholder="hello@example.com"
                          name="email"
                      />
                  </div>
                  <div class="col-12 mt-2">
                      <input
                          type="password" name="password" required
                          class="form-control"
                          placeholder="Password"
                      />
                  </div>
                  <div class="col-6">
                      <div class="form-check form-switch">
                          <input
                              class="form-check-input"
                              type="checkbox"
                              id="flexSwitchCheckDefault"
                          />
                          <label class="form-check-label" for="flexSwitchCheckDefault"
                          >Remember me</label
                          >
                      </div>
                  </div>
                  <div class="col-6 text-right">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                  </div>
                  <div class="col-12 pt-3">
                    <button type="submit" class="btn btn-primary col-12">Sign in</button>
                  </div>
                </form>
                <p class="mt-3 mb-0">
                  Don't have an account?
                  <a class="text-primary" href="{{ route('register') }}">Sign up</a>
                </p>
              </div>
            </div>
            <div class="privacy-link">
              {{-- <a href="#"
                >Have an issue with 2-factor authentication?</a
              >
              <br /> --}}
              <a href="#privacy_policy  ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
                Privacy Policy</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="{{ asset('public/mfs/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('public/mfs/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('public/mfs/js/scripts.js')}}"></script>
</body>
<!-- Mirrored from tende.vercel.app/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:21:44 GMT -->
</html>
