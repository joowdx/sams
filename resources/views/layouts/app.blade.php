<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src={{ asset('vendor/fontawesome/js/all.min.js') }}></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('styles')
</head>
<body class="hold-transition {{ Auth::check() ? 'sidebar-mini layout-fixed layout-navbar-fixed' : 'layout-top-nav' }}">
    <div id="app">
        <div class="wrapper">
                @include('layouts.sections.navbar')
                @includeWhen(Auth::check(), 'layouts.sections.sidebar')
            <div class="content-wrapper">
                @include('layouts.sections.content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script> Pace.start() </script>
    @yield('scripts')
</body>
</html>
