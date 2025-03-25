@extends('layouts.app')

@section('title', 'Thêm mới thói quen')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/thoiquen.css') }}">
@endsection

@section('content')
<div class="main-content">
    <h1>Thêm mới thói quen</h1>
    
    <form action="{{ route('thoi-quen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="habit_name">Tên thói quen</label>
            <input type="text" id="habit_name" name="habit_name" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('thoi-quen') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
