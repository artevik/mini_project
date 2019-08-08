<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bootstrap Blog - B4 Template by Bootstrap Temple</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{asset('frontend/vendor/font-awesome/css/font-awesome.min.css')}}">
        <!-- Custom icon font-->
        <link rel="stylesheet" href="{{asset('frontend/css/fontastic.css')}}">
        <!-- Google fonts - Open Sans-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
        <!-- Fancybox-->
        <link rel="stylesheet" href="{{asset('frontend/vendor/@fancyapps/fancybox/jquery.fancybox.min.css')}}">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{asset('frontend/css/style.default.css')}}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{asset('frontend/img/favicon.png')}}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

        @yield('styles')
    </head>
    <body>
    <!-- Page Header-->
    @include('frontend.partials.header')
    <!-- Page Sidebar-->
    @include('frontend.partials.sidebar')

    <!-- Latest Posts -->
    <div class="welcome-container" id="welcome">
        @yield('content')
    </div>

    <!-- Page Footer-->
    @include('frontend.partials.footer')

    <!-- JavaScript files-->
    <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('frontend/vendor/@fancyapps/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('frontend/js/front.js')}}"></script>
    <script src="{{asset('frontend/js/post-ajax.js')}}"></script>

    @stack('scripts')
    </body>
</html>
