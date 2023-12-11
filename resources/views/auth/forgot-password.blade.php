<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mighty Finance Solution | Reset Password</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/web/images/favicon.png') }}" />
    <!-- Custom Stylesheet -->
    <link href="{{ asset('public/theme/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        #background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(102, 45, 145, 0.8), rgba(145, 45, 115, 0.8)),
                        url('https://cdn03.allafrica.com/download/pic/main/main/csiid/00611742:63e77387f56223a1509fb944791b01eb:arc614x376:w735:us1.jpg');
            background-size: cover;
            background-position: center;
        }

        .authincation {
            position: relative;
        }

        .authincation-content {
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the transparency level as needed */
            border-radius: 10px;
            overflow: hidden;
        }

        .auth-form {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            margin-bottom: 5px;
        }

        @media (max-width: 767px) {
            .authincation-content {
                margin: 20px;
            }
        }
    </style>
</head>

<body class="@@dashboard">
    <div id="background-container"></div>
    <div id="main-wrapper">
        <div class="authincation section-padding">
            <div class="container">

                <div class="row justify-content-center align-items-center">
                    
                    {{-- <small>
                        <x-jet-validation-errors class="text-sm text-danger w-full" />
                    </small> --}}
                    <div class="col-xl-4 col-md-5">
                        <div class="mini-logo text-center my-3">
                            <a href="{{ route('welcome') }}">
                                <img width="100" src="{{ asset("/public/web/images/01-ft-logo.png") }}" alt="" />
                            </a>
                            <h4 class="card-title text-white mt-5">Reset Password</h4>
                        </div>
                        <div class="auth-form card">
                            <x-jet-validation-errors class="text-danger text-sm text-center w-full" />
                            <div class="card-body">
                                <form class="row g-3" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group col-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Your Email">
                                    </div>
                                    <div class="text-center  col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Email Password Reset Link</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Didn't get code? <a class="text-primary" href="otp-1.html">Resend</a></p>
                                </div>
                            </div>
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

</html>
