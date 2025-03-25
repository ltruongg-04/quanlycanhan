@extends('layouts.app')

@section('title', 'Chỉnh Sửa Công Việc')
@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/congviec.css') }}">
@endsection

@section('content')
<div class="main-content">
    <h1>Chỉnh Sửa Công Việc</h1>
    <form action="{{ route('cong-viec.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="task_name">Tên công việc:</label>
        <input type="text" id="task_name" name="task_name" value="{{ $task->task_name }}" required>

        <label for="task_date">Ngày thực hiện:</label>
        <input type="date" id="task_date" name="task_date" value="{{ $task->task_date }}" required>

        <label for="category">Loại công việc:</label>
        <select id="category" name="category">
            <option value="year" {{ $task->category == 'year' ? 'selected' : '' }}>Năm</option>
            <option value="month" {{ $task->category == 'month' ? 'selected' : '' }}>Tháng</option>
            <option value="week" {{ $task->category == 'week' ? 'selected' : '' }}>Tuần</option>
        </select>

        <button type="submit">Cập Nhật</button>
    </form>
</div>
@endsection
