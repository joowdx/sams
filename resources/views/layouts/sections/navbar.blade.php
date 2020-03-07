<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        @auth
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fad fa-bars"></i></a>
        </li>
        <li class="nav-item d-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                <i class="fad fa-fw fa-chart-network"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item d-inline-block">
            <a href="{{ route('attendance') }}" class="nav-link {{ Route::is('attendance') ? 'active' : '' }}">
                <i class="fad fa-fw fa-badge-check"></i>
                Attendance
            </a>
        </li>
        <li class="nav-item d-inline-block">
            <a href="{{ route('calendar') }}" class="nav-link {{ Route::is('calendar') ? 'active' : '' }}">
                <i class="fad fa-fw fa-calendar-check"></i>
                Calendar
            </a>
        </li>
        <li class="nav-item d-inline-block">
            <a href="{{ route('map') }}" class="nav-link {{ Route::is('map') ? 'active' : '' }}">
                <i class="fad fa-fw fa-map-marker-alt"></i>
                Map
            </a>
        </li>
        <li class="nav-item d-inline-block">
            <a href="{{ route('tags.index') }}" class="nav-link {{ Route::is('tag*') ? 'active' : '' }}">
                <i class="fad fa-fw fa-tags"></i>
                Tags
            </a>
        </li>
        @endauth
    </ul>
    <ul class="navbar-nav ml-auto">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            {{-- @include('layouts.sections.notifications') --}}
            {{-- <li class="nav-item dropdown"> --}}
                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> --}}
                    {{-- {{ Auth::user()->name }} <span class="caret"></span> --}}
                {{-- </a> --}}
                {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}

                {{-- </div> --}}
            {{-- </li> --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" id="logout" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fad fa-fw fa-sign-out-alt fa-lg"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        @endguest
    </ul>
</nav>
