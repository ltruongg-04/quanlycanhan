@extends('layouts.app')

@section('title', 'Thông Tin Cá Nhân')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/thongtincanhan.css') }}">
@endsection

@section('content')
<div class="main-content">
    <div class="if-setting">
        <div class="if-avt">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <button class="edit" onclick="window.location.href='{{ route('profile.edit') }}'">
                <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
            </button>
        </div>
        <div class="if-text">
            <p class="if">Thông tin cá nhân</p>
            <p class="name">Họ tên: {{ Auth::user()->name }}</p>
            <p class="birthday">Ngày sinh: {{ Auth::user()->birthday ? date('d/m/Y', strtotime(Auth::user()->birthday)) : 'Chưa cập nhật' }}</p>
            <p class="gender">Giới tính: {{ Auth::user()->gender ?? 'Chưa cập nhật' }}</p>
            <p class="mail">Email: {{ Auth::user()->email }}</p>
            <p class="phone">Số điện thoại: {{ Auth::user()->phone ?? 'Chưa cập nhật' }}</p>
        </div>
    </div>
</div>

<script src="{{ asset('frontend/js/menu.js') }}"></script>
@endsection
