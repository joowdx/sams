<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@yield('styles')
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
<div id="app">
<div class="wrapper">
@include('layouts.sections.navbar')
@include('layouts.sections.sidebar')
<div class="content-wrapper">
@include('layouts.sections.content')
</div>
</div>
@include('layouts.sections.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
