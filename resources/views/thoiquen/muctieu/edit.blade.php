@extends('layouts.app')

@section('title', 'Chỉnh sửa mục tiêu')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/chinhsua-muctieu-thoiquen.css') }}">
@endsection

@section('content')
<div class="edit-goal-container">
    <h2>Chỉnh sửa mục tiêu</h2>
    <form action="{{ route('muc-tieu.update', $goal->id) }}" method="POST" class="goal-form">
        @csrf
        @method('PUT')

        <label for="goal_name">Tên mục tiêu:</label>
        <input type="text" id="goal_name" name="name" value="{{ $goal->name }}" required>

        <label for="goal_progress">Tiến độ:</label>
        <input type="number" id="goal_progress" name="completed_days" value="{{ $goal->completed_days }}" required>

        <label for="goal_target">Mục tiêu:</label>
        <input type="number" id="goal_target" name="target_days" value="{{ $goal->target_days }}" required>
        
        <div class="button-group" style="justify-content:center;">
            <button type="submit" class="btn-update">Cập nhật</button>
        </div>
    </form>
    
    <form action="{{ route('muc-tieu.destroy', $goal->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">Xóa mục tiêu</button>
    </form>
</div>

@endsection
