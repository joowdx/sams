<aside class="main-sidebar sidebar-dark-light elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('/assets/img/umdc.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <div class="brand-image img-circle elevation-3" style="opacity: .8"></div>
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="img-circle elavation-2"></div>
                {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                <i class="fad fa-user-secret fa-fw fa-2x" style="color: #ecf0f1"></i>
            </div>
            <div class="info col-9">
                <a href="/profile" class="d-block">
                    {{ ($user = Auth::user())->name }}
                    @if($user->type == 'faculty' && $user->faculty)
                        @php
                            if($user->faculty->isdepartmenthead()) {
                                $l = 'dept head';
                                $c = 'danger';
                            } elseif ($user->faculty->isprogramhead()) {
                                $l = 'prog head';
                                $c = 'warning';
                            } else {
                                $c = 'success';
                            }
                        @endphp
                        <small class="float-right">
                            <span class="badge badge-{{ $c }}"> {{ $l ?? $user->type }} </span>
                        </small>
                    @elseif($user->type == 'h.r.')
                        <small class="float-right">
                            <span class="badge badge-primary"> h.r. </span>
                        </small>
                    @elseif($user->type == 'admin')
                        <small class="float-right">
                            <span class="badge badge-dark"> admin </span>
                        </small>
                    @endif
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('admin_view', App\User::class)
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
                <li class="nav-item">
                    <a href="{{ route('readers.index') }}" class="nav-link {{ request()->is('readers*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-signal-stream fa-fw"></i>
                        <p> Readers </p>
                    </a>
                </li>
                @endcan

                @can('admin_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('academicperiods.index') }}" class="nav-link {{ request()->is('academicperiods*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-calendar-week fa-fw"></i>
                            <p> Periods </p>
                        </a>
                    </li>
                @endcan

                @can('admin_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('departments.index') }}" class="nav-link {{ request()->is('departments*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-university fa-fw"></i>
                            <p> Departments </p>
                        </a>
                    </li>
                @endcan

                @can('programs_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('programs.index') }}" class="nav-link {{ request()->is('events*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-solar-system fa-fw"></i>
                            <p> Programs </p>
                        </a>
                    </li>
                @endcan

                @can('courses_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('courses.index') }}" class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-book-spells fa-fw"></i>
                            <p> Courses </p>
                        </a>
                    </li>
                @endcan

                @can('faculties_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('faculties.index') }}" class="nav-link {{ request()->is('faculties*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-chalkboard-teacher fa-fw"></i>
                            <p> Faculties </p>
                        </a>
                    </li>
                @endcan

                @can('students_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}" class="nav-link {{ request()->is('students*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-users-class fa-fw"></i>
                            <p> Students </p>
                        </a>
                    </li>
                @endcan

                @can('admin_view', App\User::class)
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                            <i class="nav-icon fad fa-users-crown fa-fw"></i>
                            <p> Users </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                        <i class="nav-icon fad fa-cogs fa-fw"></i>
                        <p> Settings </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
