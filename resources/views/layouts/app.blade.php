<!DOCTYPE html>
<html lang="vi" @yield('html-class')>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Lý Công Việc')</title>
    
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/asset/fontawesome-free-6.6.0-web/css/all.css') }}">
    
    @yield('head') 
</head>
<body>
    <div class="sidebar">
        
        @if(auth()->check())
            <div class="user-profile">
                <div class="avatar">{{ strtoupper(auth()->user()->name[0] ?? 'U') }}</div>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <button id="info-btn" class="info hidden">Thông tin cá nhân</button>
            <button id="logout-btn" class="logout hidden">Đăng xuất</button>
            
        @else
            <div class="user-profile">
                <div class="avatar">U</div>
                <span><a href="{{ route('login') }}">Đăng nhập</a></span>
            </div>
        @endif

        <ul class="menu-list">
            <li class="menu-item" data-page="{{ route('home') }}">
                <i class="fa-solid fa-house"></i>Trang chủ
            </li>
            <li class="menu-item has-submenu" id="thoiquen-menu">
                <i class="fa-solid fa-list-check"></i>Thói quen
                <ul class="submenu hidden">
                    <span style="display: flex;">
                        <li class="submenu-item" data-page="{{ route('thoi-quen') }}">Thói quen</li>
                        <li class="submenu-item" data-page="{{ route('muc-tieu') }}">Mục tiêu</li>
                    </span>
                </ul>
            </li>
            <li class="menu-item" data-page="{{ route('cong-viec') }}">
                <i class="fa-solid fa-briefcase"></i>Công việc
            </li>
            <li class="menu-item" data-page="">
                <i class="fa-solid fa-face-smile"></i>Cảm xúc
            </li>
            <li class="menu-item" data-page="{{ route('ho-tro') }}">
                <i class="fa-solid fa-circle-info"></i>Hỗ trợ
            </li>
            <li class="menu-item" id="thongbao-menu">
                <i class="fa-solid fa-bell"></i>Thông báo
            </li>
        </ul>
        <div id="notification-panel" class="hidden">
            <div class="notification-item">
                <i class="fa-solid fa-xmark"></i>
                <span>
                    <p> Bạn đã bỏ lỡ thói quen đọc sách hôm qua. Hãy tiếp tục duy trì nhé!!</p>
                    <small>30 phút trước</small>
                </span>
            </div>
            <div class="notification-item">
                <i class="fa-solid fa-check-to-slot"></i>
                <span>
                    <p>Bạn đã duy trì thói quen đọc sách
                        liên tiếp 7 ngày. Bạn làm tốt lắm!!</p>
                    <small>Hôm qua</small>
                </span>
            </div>
            <div class="notification-item">
                <i class="fa-solid fa-chart-line"></i>
                <span>
                    <p>Bạn đã hoàn thành hết công việc của
                        hôm nay. Bạn làm tốt lắm!!</p>
                    <small>Hôm qua</small>
                </span>
            </div>
            <div class="notification-item">
                <i class="fa-solid fa-repeat"></i>
                <span>
                    <p>Đã đến lúc kiểm tra tiến độ công việc tuần
                        này rồi.</p>
                    <small>2 ngày trước</small>
                </span>
            </div>
        </div>
    </div>

    <div class="main-content">
        @yield('content') 
    </div>

    @if(auth()->check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif

    <script src="{{ asset('frontend/js/menu.js') }}"></script>
    @yield('scripts') 
</body>
</html>
