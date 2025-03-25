@extends('layouts.app')

@section('title', 'Chỉnh sửa thông tin cá nhân')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/chinhsuattcn.css') }}">
@endsection


@section('content')
<div class="main-content">
    <div class="if-setting">
        <div class="if-avt">
            <button class="back" onclick="window.location.href='{{ route('profile.show') }}'">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </button>
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        </div>
        <div class="if-text">
            <p class="if">Chỉnh sửa thông tin cá nhân</p>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <label for="name">Họ tên:</label>
                <input type="text" name="name" value="{{ $user->name }}" required>

                <label for="birthday">Ngày sinh:</label>
                <input type="date" name="birthday" value="{{ $user->birthday }}" required>

                <label for="gender">Giới tính:</label>
                <select name="gender" required>
                    <option value="Nam" {{ $user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ $user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    <option value="Khác" {{ $user->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                </select>

                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required>

                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" value="{{ $user->phone }}" required>

                <button type="submit" class="save" onclick="window.location.href='{{ route('profile.show') }}'">
                    <i class="fa-solid fa-download"></i> Lưu
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
