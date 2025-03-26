<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/trangchu-admin.css') }}">
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
        <div class="header">
            <h1>Good Morning, Admin</h1>
        </div>

        <div class="calendar">
            <header>
                <h3></h3>
                <nav>
                    <button id="prev"></button>
                    <button id="next"></button>
                </nav>
            </header>
            <section>
                <ul class="days">
                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
                </ul>
                <ul class="dates"></ul>
            </section>
        </div>

        <canvas id="chartCanvas" width="800" height="400"></canvas>
        <div class="label">Số lượng người dùng truy cập hàng ngày</div>
    </div>

    <script src="{{ asset('frontend/js/trangchu.js') }}"></script>
    <script src="{{ asset('frontend/js/menu.js') }}"></script>
    <script>
        const canvas = document.getElementById("chartCanvas");
        const ctx = canvas.getContext("2d");

        const data = [50, 80, 60, 120, 150, 100, 170, 80, 200, 250, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30];
        const days = Array.from({ length: 31 }, (_, i) => i + 1);

        function drawAxes() {
            ctx.beginPath();
            ctx.moveTo(50, 350);
            ctx.lineTo(750, 350);
            ctx.moveTo(50, 50);
            ctx.lineTo(50, 350);
            ctx.strokeStyle = "#000";
            ctx.stroke();
        }

        function drawLabels() {
            ctx.font = "12px Arial";
            ctx.fillStyle = "#000";

            days.forEach((day, index) => {
                let x = 50 + (index * 23);
                ctx.fillText(day, x, 365);
            });

            const yLabels = [0, 50, 100, 150, 200, 250, 300];
            yLabels.forEach((label, index) => {
                let y = 350 - (index * 50);
                ctx.fillText(label, 20, y);
            });
        }

        function drawChart() {
            ctx.beginPath();
            ctx.strokeStyle = "#000";
            ctx.lineWidth = 2;

            data.forEach((value, index) => {
                let x = 50 + (index * 23);
                let y = 350 - (value / 300) * 300;

                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });

            ctx.stroke();
        }

        function draw() {
            drawAxes();
            drawLabels();
            drawChart();
        }

        draw();
    </script>
</body>
</html>
