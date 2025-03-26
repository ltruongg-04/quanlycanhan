<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang cá nhân</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/thongtinnguoidung.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/asset/fontawesome-free-6.6.0-web/css/all.css') }}">
</head>

<body>
    <div class="sidebar">
        <div class="user-profile">
            <div class="avatar">A</div>
            <span>Admin</span>
        </div>

        <button id="logout-btn" class="logout hidden">Đăng xuất</button>

        <ul class="menu-list">
            <li class="menu-item" data-page="{{ route('admin.home') }}">
                <i class="fa-solid fa-house"></i>Trang chủ
            </li>
            <li class="menu-item" data-page="{{ route('admin.users') }}">
                <i class="fa-solid fa-users"></i>Quản lý người dùng
            </li>
            <li class="menu-item" data-page="{{ route('admin.notifications') }}">
                <i class="fa-solid fa-bell"></i>Quản lý thông báo
            </li>
            <li class="menu-item">
                <i class="fa-solid fa-circle-info"></i>Hỗ trợ khách hàng
            </li>
            <li class="menu-item">
                <i class="fa-solid fa-signal"></i>Thống kê báo cáo
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="if-setting">
            <div class="if-avt">
                <div class="avatar">A</div>
            </div>
            <div class="if-text">
                <p class="if">Thông tin cá nhân</p>
                <p class="name">Họ tên: {{ $user->name }}</p>
                <p class="birthday">Ngày sinh: {{ $user->birthday }}</p>
                <p class="gender">Giới tính: {{ $user->gender }}</p>
                <p class="mail">Email: {{ $user->email }}</p>
                <p class="phone">Số điện thoại: {{ $user->phone }}</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/menu.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editBtn = document.querySelector(".edit");
            if (editBtn) {
                editBtn.addEventListener("click", function () {
                    window.location.href = "";
                });
            }
        });
    </script>

</body>

</html>
