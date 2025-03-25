<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/signup.css') }}">
</head>

<body>
    <form action="{{ route('register') }}" method="POST" class="dangky">
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
                        <p> <a href="{{ route('login') }}">Đăng nhập</a> </p>
                    </div>
                    <div class="text2">
                        <p>Đăng ký</p>
                    </div>
                </div>
                <div style="margin-top: 50px;">
                    <div class="block2">
                        <img src="{{ asset('frontend/asset/img/user.png') }}" alt="">
                        <nav>
                            <p>Tên đăng nhập</p>
                            <input type="text" name="name" required>
                        </nav>
                    </div>
                    <div class="block2">
                        <img src="{{ asset('frontend/asset/img/password.png') }}" alt="">
                        <nav>
                            <p>Mật khẩu</p>
                            <input type="password" name="password" required>
                        </nav>
                    </div>
                    <nav style="margin: 20px 0 0 158px;">
                        <p>Xác nhận mật khẩu</p>
                        <input type="password" name="password_confirmation" required>
                    </nav>
                </div>

                <button type="submit" class="btn">Đăng ký</button>
            </div>
        </div>
    </form>
</body>

</html>
