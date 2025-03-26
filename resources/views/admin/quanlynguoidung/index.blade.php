<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/quanlynguoidung.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
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
        <div class="header">Danh sách người dùng</div>

        <div class="container">
            <div class="user-list">
                @foreach ($users as $user)
                    <div class="user" data-name="{{ $user['name'] }}">
                        <span>{{ $user['name'] }}</span> <span>ID: {{ str_pad($user['id'], 4, '0', STR_PAD_LEFT) }}</span>
                        <button onclick="viewDetails({{ $user['id'] }})">Xem chi tiết</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/menu.js') }}"></script>

    <script>
        function filterUsers(letter) {
            const users = document.querySelectorAll(".user");
            users.forEach(user => {
                const name = user.getAttribute("data-name");
                if (name.startsWith(letter)) {
                    user.style.display = "flex";
                } else {
                    user.style.display = "none";
                }
            });
        }

        function resetFilter() {
            const users = document.querySelectorAll(".user");
            users.forEach(user => {
                user.style.display = "flex";
            });
        }

        function viewDetails(userId) {
            window.location.href = "{{ url('/admin/users') }}/" + userId;
        }
    </script>
</body>

</html>
