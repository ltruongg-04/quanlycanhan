@extends('layouts.app')

@section('title', 'Thêm mới Mục tiêu')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/themmoi-muctieu-thoiquen.css') }}">
@endsection

@section('content')
<div class="main-content">
    <h1>Thêm mới Mục tiêu</h1>

    <form action="{{ route('muc-tieu.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên mục tiêu</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="target_days">Số ngày mục tiêu</label>
            <input type="number" id="target_days" name="target_days" class="form-control" min="1" max="31" required>
        </div>

        <button type="submit" class="btn btn-success">Thêm mới</button>
        <a href="{{ route('muc-tieu') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
