<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">
</head>

<body>
    <form action="{{ route('login') }}" method="POST" class="dangnhap">
        @csrf
        <div class="left">
            <img src="{{ asset('frontend/asset/img/1.png') }}" alt="" class="img1">
            <img src="{{ asset('frontend/asset/img/2.png') }}" alt="" class="img2">
            <img src="{{ asset('frontend/asset/img/3.png') }}" alt="" class="img3">
            <img src="{{ asset('frontend/asset/img/4.png') }}" alt="" class="img4">
        </div>
        <div class="right">
            <div class="block">
                <div class="block1">
                    <div class="text1">
                        <p>Đăng nhập</p>
                    </div>
                    <div class="text2">
                        <p> <a href="{{ route('register') }}">Đăng ký</a> </p>
                    </div>
                </div>
                <div style="margin-top: 50px;">
                    <div class="block2">
                        <img src="{{ asset('frontend/asset/img/user.png') }}" alt="">
                        <nav>
                            <p>Tên đăng nhập</p>
                            <input type="text" name="name" placeholder="" required>
                        </nav>
                    </div>
                    <div class="block2">
                        <img src="{{ asset('frontend/asset/img/password.png') }}" alt="">
                        <nav>
                            <p>Mật khẩu</p>
                            <input type="password" name="password" placeholder="" required>
                        </nav>
                    </div>
                </div>
                <button type="submit" class="btn">Đăng nhập</button>
            </div>
        </div>
    </form>
</body>

</html>
