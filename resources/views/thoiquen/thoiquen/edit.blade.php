@extends('layouts.app')

@section('title', 'Chỉnh sửa thói quen')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/thoiquen.css') }}">
@endsection

@section('content')
<div class="main-content">
    <h1>Chỉnh sửa thói quen</h1>

    <form action="{{ route('thoi-quen.update', $habit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="habit_name">Tên thói quen</label>
            <input type="text" id="habit_name" name="habit_name" class="form-control" value="{{ $habit->habit_name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('thoi-quen') }}" class="btn btn-secondary">Hủy</a>
    </form>

    <form action="{{ route('thoi-quen.destroy', $habit->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thói quen này không?');">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Xóa thói quen</button>
    </form>
</div>
@endsection
