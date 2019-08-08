<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

    <!-- Fonts -->

    @yield('styles')
</head>
<body class="app">
    @include('dashboard.partials.header')
    @include('dashboard.partials.sidebar')

    <main class="app-content" id="app">
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
