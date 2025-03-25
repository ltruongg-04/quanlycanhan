@extends('layouts.app')

@section('title', 'Hỗ trợ & Câu hỏi thường gặp')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/hotro.css') }}">
@endsection

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Good Morning, {{ Auth::user()->name ?? 'Người dùng' }}</h1>
        <h2 id="current-date"></h2>
        <div class="btn">
            <button class="qs">Các câu hỏi thường gặp</button>
            <button class="mail"><i class="fa-solid fa-envelope"></i> Liên hệ</button>
        </div>
    </div>

    <div class="content">
        <div class="faq-container">
            <p class="faq-intro">
                Xin chào, dưới đây là những câu hỏi thường gặp giúp bạn nhanh chóng tìm ra câu trả lời cho vấn đề bạn gặp phải khi sử dụng. Nếu bạn không tìm thấy thông tin mình cần, hãy liên hệ với chúng tôi để được hỗ trợ nhé.
            </p>
            <div class="faq-grid">
                @foreach([
                    ['Web này dùng để làm gì?', 'Web giúp bạn quản lý công việc, theo dõi thói quen và tối ưu hóa năng suất cá nhân.'],
                    ['Tôi có thể sử dụng miễn phí không?', 'Hiện tại, bạn có thể sử dụng miễn phí tất cả các tính năng của web.'],
                    ['Dữ liệu của tôi có được bảo mật không?', 'Chúng tôi sử dụng mã hóa dữ liệu và bảo vệ quyền riêng tư theo tiêu chuẩn cao nhất.'],
                    ['Làm sao để đóng góp về tính năng mới?', 'Hãy gửi tin nhắn liên hệ với tôi ở phần “Liên hệ” nhé.'],
                    ['Tôi đã gửi yêu cầu hỗ trợ qua liên hệ, bao lâu thì tôi sẽ nhận được phản hồi?', 'Thời gian phản hồi trung bình là 24 giờ nhé!'],
                    ['Web có thường xuyên cập nhật tính năng mới không?', 'Có, chúng tôi luôn lắng nghe phản hồi từ người dùng để cải thiện và bổ sung tính năng mới.'],
                ] as $faq)
                    <div class="faq-item">
                        <h3>{{ $faq[0] }}</h3>
                        <p>{{ $faq[1] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('frontend/js/hotro.js') }}"></script>
@endsection
