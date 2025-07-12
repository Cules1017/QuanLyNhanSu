<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Đăng xuất</span>
                        </a>
                    </form>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                @php
                    $user = auth()->user();
                    $unreadCount = 0;
                    $unreadNotifications = [];
                    if ($user && isset($user->ma_nhan_vien)) {
                        $unreadNotifications = \App\Models\NotificationTarget::with('notification')
                            ->where('ma_nhan_vien', $user->ma_nhan_vien)
                            ->where('da_xem', false)
                            ->orderByDesc('created_at')
                            ->limit(5)
                            ->get();
                        $unreadCount = \App\Models\NotificationTarget::where('ma_nhan_vien', $user->ma_nhan_vien)
                            ->where('da_xem', false)
                            ->count();
                    }
                @endphp
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="#" class="nav-link text-white p-0 position-relative" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @if($unreadCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:10px;">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="notificationDropdown" style="min-width: 320px;">
                        <li class="mb-2"><strong>Thông báo chưa đọc</strong></li>
                        @forelse($unreadNotifications as $item)
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('user.notifications.show', $item->id) }}">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">{{ $item->notification->tieu_de ?? 'Thông báo' }}</span>
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ $item->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted">Không có thông báo mới.</span></li>
                        @endforelse
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="{{ route('user.notifications.index') }}">Xem tất cả thông báo</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
