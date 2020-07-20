<?php

if(Auth::check()) {
    $settings = Auth::user()->settings;

    $settingsdarkmode = @$settings->first(function($settings) {
        return $settings->name == 'darkmode';
    })->value;

    $settingssidebartoggle = @$settings->first(function($settings) {
        return $settings->name == 'toggle';
    })->value ?? 'sidebar-mini';

    $settingssidebaronload = @$settings->first(function($settings) {
        return $settings->name == 'onload';
    })->value ?? '';


    if(Route::is('map')) { }

    else if($settingsdarkmode == 'auto') {
        echo '<script>followSystemColorScheme()</script>';
    } else if($settingsdarkmode == 'enable') {
        echo '<script>enableDarkMode()</script>';
    }
}

?>
<body class="hold-transition {{ Auth::check() ? @$settingssidebartoggle . ' ' . @$settingssidebaronload : 'layout-top-nav' }}">
    <div id="app">
        <div class="wrapper">
            @include('layouts.sections.navbar')
            @includeWhen(Auth::check(), 'layouts.sections.sidebar')
            <div class="content-wrapper">
                @include('layouts.sections.content')
            </div>
        </div>
    </div>
    <script> Pace.start() </script>
    @yield('scripts')
</body>

<?php

unset($settings, $settingsdarkmode, $settingssidebartoggle, $settingssidebaronload);

?>
