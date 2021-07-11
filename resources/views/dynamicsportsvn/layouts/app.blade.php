<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dynamic Sport </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="manifest" href="site.webmanifest"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dynamic/assets/css/main.css') }}">
</head>

<body>

<!-- Preloader Start -->
{{-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/logo.png" alt="">
            </div>
        </div>
    </div>
</div> --}}
<!-- Preloader Start -->

@include('dynamicsportsvn.layouts.header')
@yield('content')

@include('dynamicsportsvn.layouts.footer')

<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->
<script src="{{ asset('dynamic/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ asset('dynamic/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/bootstrap.min.js') }}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{ asset('dynamic/assets/js/jquery.slicknav.min.js') }}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ asset('dynamic/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/slick.min.js') }}"></script>

<!-- One Page, Animated-HeadLin -->
<script src="{{ asset('dynamic/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/animated.headline.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/jquery.magnific-popup.js') }}"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="{{ asset('dynamic/assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/jquery.sticky.js') }}"></script>

<!-- contact js -->
<script src="{{ asset('dynamic/assets/js/contact.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/jquery.form.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/mail-script.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/jquery.ajaxchimp.min.js') }}"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="{{ asset('dynamic/assets/js/plugins.js') }}"></script>
<script src="{{ asset('dynamic/assets/js/main.js') }}"></script>
@stack('after-js')
</body>
</html>
