@extends('layouts.app')

@section('title', 'Thêm Công Việc')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/themmoicongviec.css') }}">
@endsection

@section('content')
<div class="main-content">
    <h1>Thêm Công Việc</h1>
    <form action="{{ route('cong-viec.store') }}" method="POST">
        @csrf
        <label for="task_name">Tên công việc:</label>
        <input type="text" id="task_name" name="task_name" required>

        <label for="task_date">Ngày thực hiện:</label>
        <input type="date" id="task_date" name="task_date" required>

        <label for="category">Loại công việc:</label>
        <select id="category" name="category">
            <option value="year">Năm</option>
            <option value="month">Tháng</option>
            <option value="week">Tuần</option>
        </select>

        <button type="submit">Lưu</button>
    </form>
</div>
@endsection
