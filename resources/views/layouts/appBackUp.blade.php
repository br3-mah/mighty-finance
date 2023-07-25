<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Bridgetrust Finance | The Financial bridge you can trust</title>
        <!-- Favicons Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/images/logo-full.png') }}" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/images/logo-full.png') }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/images/logo-full.png') }}" />
        <link rel="manifest" href="{{ asset('public/images/logo-full.png') }}" />
        <meta name="description" content="Bridgetrust Finance" />
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet">
    
        <link rel="stylesheet" href="{{ asset('public/box/vendors/animate/animate.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/animate/custom-animate.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/bxslider/jquery.bxslider.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/fontawesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/jquery-ui/jquery-ui.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/nice-select/nice-select.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/odometer/odometer.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/owl-carousel/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/owl-carousel/owl.theme.default.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/swiper/swiper.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/vegas/vegas.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/vendors/thm-icons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/vendors/language-switcher/polyglot-language-switcher.css') }}">
        <!-- Module css -->
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/01-header-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/02-banner-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/03-about-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/04-fact-counter-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/05-testimonial-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/06-partner-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/07-footer-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/08-blog-section.css') }}">
    
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/09-breadcrumb-section.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/module-css/10-contact.css') }}">
        <!--  styles -->
        <link rel="stylesheet" href="{{ asset('public/box/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/box/css/responsive.css') }}" />
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="{{ asset('public/box/css/bd-wizard.css') }}">
        <link rel="stylesheet" href="{{ asset('public/box/css/responsive.css') }}" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

        @livewireStyles

        <!-- Scripts -->
        {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />
   
        @include('livewire.components.preloader')
    
    
        <div class="page-wrapper">
            
            @include('layouts.menu')
    
            <div class="stricky-header stricked-menu main-menu">
                <div class="sticky-header__content"></div>
            </div>
            
            {{ $slot }}
                
            @stack('modals')

            @livewireScripts 

            @include('layouts.footer')
        </div>
        @include('layouts.mobile-nav')
        <!-- End preloader -->
    
        @livewire('components.search')
        <!-- End preloader -->
    
    
        <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
            <i class="icon-chevron"></i>
        </a>
    
    
        <script src="{{ asset('public/box/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/circleType/jquery.circleType.js') }}"></script>
        <script src="{{ asset('public/box/vendors/circleType/jquery.lettering.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/isotope/isotope.js') }}"></script>
        <script src="{{ asset('public/box/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/jquery-migrate/jquery-migrate.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/jquery-ui/jquery-ui.js') }}"></script>
        <script src="{{ asset('public/box/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/odometer/odometer.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/swiper/swiper.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/vegas/vegas.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/wnumb/wNumb.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/wow/wow.js') }}"></script>
        <script src="{{ asset('public/box/vendors/extra-scripts/jquery.paroller.min.js') }}"></script>
        <script src="{{ asset('public/box/vendors/language-switcher/jquery.polyglot.language.switcher.js') }}"></script>
    
        <!--  js -->
        <script src="{{ asset('public/box/js/custom.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    
        <script src="{{ asset('public/box/js/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('public/box/js/bd-wizard.js') }}"></script>
    
        <!--Start of Tawk.to Script-->
        {{-- <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/63f633974247f20fefe20a7e/1gpsrj2mc';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script> --}}
        <!--End of Tawk.to Script-->
    </body>
</html>
