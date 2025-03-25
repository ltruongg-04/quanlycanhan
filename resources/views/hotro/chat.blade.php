@extends('layouts.app')

@section('title', 'Hỗ trợ & Liên hệ')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/hotrolienhe.css') }}">
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
    
    <div class="chat-box">
        <div class="message sent">
            <p>Chào, mình muốn đề xuất một tính năng mới cho web. Mình nghĩ web nên có tính năng thêm ghi chú. Đôi khi mình muốn ghi nhanh một ý tưởng hoặc lưu lại thông tin quan trọng, nhưng chưa có chỗ nào để làm điều đó.</p>
            <span class="time">5 giờ trước</span>
        </div>
        <div class="message received">
            <p>Chào bạn! Cảm ơn vì đã đóng góp ý tưởng. Đó là một ý tưởng hay! Bạn có thể chia sẻ thêm về cách bạn muốn tính năng này hoạt động không?</p>
            <span class="time">3 giờ trước</span>
        </div>
        <div class="message sent">
            <p> Mình muốn có một mục riêng để tạo và lưu ghi chú. Nếu có thể, mình muốn sắp xếp theo danh mục hoặc gắn nhãn để dễ tìm lại. Ngoài ra, nếu ghi chú có thể liên kết với công việc thì càng tốt!</p>
            <span class="time">3 giờ trước</span>
        </div>
    </div>
    
    <div class="chat-input">
        <input type="text" id="message-input" placeholder="Nhập tin nhắn...">
        <button id="send-btn"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<script src="{{ asset('frontend/js/hotrolienhe.js') }}"></script>
@endsection
