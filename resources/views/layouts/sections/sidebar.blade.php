<aside class="main-sidebar sidebar-dark-light elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('storage/umdc.png') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <div class="brand-image img-circle elevation-3" style="opacity: .8"></div>
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <div class="sidebar">
        @if (Auth::check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <div class="img-circle elavation-2"></div>
                    {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                    <i class="fad fa-user-secret fa-fw fa-2x" style="color: #ecf0f1"></i>
                </div>
                <div class="info">
                    <a href="/users/{{Auth::user()->id}}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
        @endif
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('aview', App\User::class)
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fad fa-bug fa-fw"></i>
                        <p>
                            Debugging
                            <i class="right fad fa-angle-left fa-fw"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('telescope') }}" class="nav-link">
                                <i class="nav-icon fad fa-sparkles fa-fw"></i>
                                <p>
                                    Telescope
                                    <span class="right badge badge-dark d-none"> Debug </span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('websockets') }}" class="nav-link">
                                <i class="nav-icon fad fa-satellite fa-fw"></i>
                                <p>
                                    Websockets
                                    <span class="right badge badge-dark d-none"> Debug </span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a href="{{ route('telescope') }}" class="nav-link">
                                <i class="nav-icon fad fa-yin-yang fa-fw" data-fa-transform="rotate-270" style="--fa-primary-color: #c2c7d0; --fa-secondary-color: #5c5f63; --fa-secondary-opacity: 1"></i>
                                <i class="fas fa-circle fa-fw" data-fa-transform="shrink-9" style="color: #5c5f63; position: absolute; left: 15px; top: 10px"></i>
                                <i class="fas fa-circle fa-fw" data-fa-transform="shrink-9" style="color: #c2c7d0; position: absolute; left: 25px; top: 10px"></i>
                                <p>
                                    Horizon
                                    <span class="right badge badge-dark"> Debugging </span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                {{-- @can('fview', App\AcademicPeriod::class) --}}
                <li class="nav-item">
                    <a href="{{ route('academicperiods.index') }}" class="nav-link {{ request()->is('academicperiod*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-calendar-week fa-fw"></i>
                        <p> Academic Period </p>
                    </a>
                </li>
                {{-- @endcan --}}
                @can('fview', App\User::class)
                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link {{ request()->is('students*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-users-class fa-fw"></i>
                        <p> Students </p>
                    </a>
                </li>
                @endcan
                @can('rview', App\User::class)
                <li class="nav-item">
                    <a href="{{ route('courses.index') }}" class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-book-spells fa-fw"></i>
                        <p> Courses </p>
                    </a>
                </li>
                @endcan
                @can('hview', App\User::class)
                <li class="nav-item">
                    <a href="{{ route('faculties.index') }}" class="nav-link {{ request()->is('faculties*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-chalkboard-teacher fa-fw"></i>
                        <p> Faculties </p>
                    </a>
                </li>
                @endcan
                @can('aview', App\User::class)
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-users-crown fa-fw"></i>
                        <p> Users </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configurations.index') }}" class="nav-link {{ request()->is('configurations*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-cogs fa-fw"></i>
                        <p> Configurations </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>
