<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign Up - Mighty Finance Solution</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/web/images/favicon.png') }}">
    <link href="{{ asset('public/theme/css/style.css') }}" rel="stylesheet">
    <script src="https://jsuites.net/v4/jsuites.js"></script>
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        a{
            color: rgb(255, 187, 0);
        }
        #background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(102, 45, 145, 0.89), rgba(145, 45, 115, 0.8)),
                        url('https://www.shutterstock.com/image-photo/market-woman-making-phone-call-260nw-1898142157.jpg');
            background-size: cover;
            background-position: center;
        }

        .authincation {
            position: relative;
        }

        .authincation-content {
            margin-top: 0%;
            background-color: #662d91d3; /* Adjust the transparency level as needed */
            border-radius: 0px;
            overflow: hidden;
            margin-right: -16%;
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
                margin: 0px;
                width: 100%;
            }
        }
        .float-alert-bar {
            position: absolute;
            padding: 15px;
            width: 100%;
            background-color: #dc3545; /* Choose a background color that suits your design */
            color: #fff; /* Text color */
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 99999; /* Ensure it appears above other elements */
            display: block; /* Hide it by default */
        }



    </style>
</head>

<body class="h-100">
    <x-jet-validation-errors class="mb-4 text-xs float-alert-bar" style="color:rgb(255, 255, 255)" />
    <div id="background-container"></div>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-end h-100 align-items-end">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="logo justify-content-center justify-center items-center text-center">
                                        <a href="{{ route('welcome') }}">
                                            <img width="50" src="{{ asset("/public/web/images/01-ft-logo.png") }}" alt="">
                                        </a>
                                    </div>
                                    <h4 class="text-center text-white mb-4">Create your account</h4>
                                    
                               

                                    <form method="POST" class="text-white" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>First Name</strong></label>
                                                    <input name="fname" :value="old('fname')" required type="text" class="form-control" placeholder="Your First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>Last Name</strong></label>
                                                    <input name="lname" :value="old('lname')" required type="text" class="form-control" placeholder="Your Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input name="email" :value="old('email')" required type="email" class="form-control" placeholder="yourname@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input name="password" required autocomplete="new-password" type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input name="password_confirmation" required autocomplete="new-password" type="password" class="form-control">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
										@if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
										<div class="form-check">
											<input type="checkbox" name="terms" class="form-check-input" id="termsCheckbox">
											<label class="form-check-label font-w400" for="termsCheckbox">{!! __('I agree to the :terms_of_service and :privacy_policy', [
												'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
												'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
											]) !!}</label>
										</div>
                                        <p>Already have an account? <a class="text-warning" href="{{ route('login') }}">Sign in</a></p>
										@endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
    Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('public/theme/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/theme/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/theme/js/deznav-init.js') }}"></script>

</body>
</html>
