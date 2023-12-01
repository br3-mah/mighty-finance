

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
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/mfs/images/logoi.png')}}" />
    <!-- Custom Stylesheet -->
     
    <link rel="stylesheet" href="{{ asset('public/mfs/css/style.css')}}" />
  </head>

  <body class="@@dashboard">
 <div id="preloader"><i>.</i><i>.</i><i>.</i></div>


<div id="main-wrapper">
  <div class="authincation section-padding">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-xl-5 col-md-6">
          <div class="mini-logo text-center my-4">
            <a href="{{ route('welcome') }}">
                <img width="200" src="{{ asset('public/web/images/logo.png')}}" alt="" />
            </a>
            <h4 class="card-title mt-5">Sign in to Account</h4>
          </div>
          <div class="auth-form card">
            
            <x-jet-validation-errors class="alert text-center alert-danger text-danger text-xs" />
            <div class="card-body">
              <form
                name="myform"
                class="signin_validate row g-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-12">
                    <input
                        type="email" name="email" :value="old('email')"
                        class="form-control"
                        placeholder="hello@example.com"
                        name="email"
                    />
                </div>
                <div class="col-12">
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
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
              </form>
              <p class="mt-3 mb-0">
                Don't have an account?
                <a class="text-primary" href="{{ route('password.request') }}">Sign up</a>
              </p>
            </div>
          </div>
          <div class="privacy-link">
            {{-- <a href="#"
              >Have an issue with 2-factor authentication?</a
            >
            <br /> --}}
            <a href="signup.html">Privacy Policy</a>
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
