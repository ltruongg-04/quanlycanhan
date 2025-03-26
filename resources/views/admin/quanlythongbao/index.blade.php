<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thông báo</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/quanlythongbao.css') }}">
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
        <div class="buttons">
            <div class="tab active" data-tab="da-gui">Danh sách thông báo đã gửi</div>
            <div class="tab" data-tab="chua-gui">Danh sách thông báo chưa gửi</div>
            <div class="tab" data-tab="tao-moi">Tạo thông báo mới</div>
        </div>
        <div class="tab-content" id="da-gui-ct">
            @foreach ($sent_notifications as $notification)
                <div class="notification">
                    <i class="{{ $notification['icon'] }}"></i>
                    <div class="content">
                        <p><b>{{ $notification['message'] }}</b></p>
                        <span class="time">{{ $notification['time'] }}</span>
                    </div>
                    <span class="user"><i class="fa-solid fa-user"></i> {{ $notification['user'] }}</span>
                </div>
            @endforeach
        </div>
        <div class="tab-content hidden" id="chua-gui-ct">
            @foreach ($unsent_notifications as $notification)
                <div class="notification">
                    <i class="{{ $notification['icon'] }}"></i>
                    <div class="content">
                        <p><b>{{ $notification['message'] }}</b></p>
                        <span class="time">{{ $notification['time'] }}</span>
                    </div>
                    <span class="user"><i class="fa-solid fa-user"></i> {{ $notification['user'] }}</span>
                    <button class="delete-btn">Xóa</button>
                </div>
            @endforeach
        </div>
        <div class="tab-content hidden" id="tao-moi-ct">
            <form action="{{ route('admin.notifications.store') }}" method="POST">
                @csrf
                <div class="notification-form">
                    <div class="left-section">
                        <label for="message"><i class="fa-solid fa-align-left"></i> Nội dung thông báo:</label>
                        <textarea id="message" name="message" placeholder="Nhập nội dung tại đây"></textarea>

                        <label for="datetime"><i class="fa-solid fa-clock"></i> Thời gian gửi:</label>
                        <input type="datetime-local" name="send_time">
                    </div>

                    <div class="right-section">
                        <label><i class="fa-solid fa-user-pen"></i> Đối tượng gửi:</label>
                        <input type="text" name="receiver" placeholder="ID người nhận hoặc nhóm người nhận">
                    </div>
                </div>
                <button type="submit" class="save-btn">Lưu</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('frontend/js/menu.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll(".tab");
            const contents = document.querySelectorAll(".tab-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    tabs.forEach(t => t.classList.remove("active"));
                    tab.classList.add("active");

                    contents.forEach(content => content.classList.add("hidden"));
                    document.getElementById(`${tab.dataset.tab}-ct`).classList.remove("hidden");
                });
            });
        });
    </script>

</body>
</html>
