<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fad fa-bell fa-fw fa-lg"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width:360px">
        <div class="dropdown-header clearfix px-2 mx-2">
            <span class="float-left">Notifications({{ Auth::user()->notifications->count() }})</span>
            <a href="javascript:void(0)">
                <span class="float-right align-bottom">Mark all as read</span>
            </a>
        </div>
        <div class="dropdown-divider"></div>
        @forelse (Auth::user()->unreadNotifications as $notification)
            <a href="#" class="dropdown-item">
                <i class="fas fa-envelope fa-fw mr-2"></i>
                {{ @$notification->data['message'] }}
                <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            @if($loop->last)
                <div class="dropdown-divider"></div>
                <div class="dropdown-header clearfix px-2 mx-2">
                    <a href="javascript:void(0)">
                        <span class="float-left align-bottom">See all notifications</span>
                    </a>
                </div>
            @endif
        @empty
            <a href="#" class="dropdown-item">
                <i class="fas fa-info fa-fw mr-2"></i> No notifications
                <span class="float-right text-muted text-sm">3 mins</span>
            </a>
        @endforelse
    </div>
</li>
