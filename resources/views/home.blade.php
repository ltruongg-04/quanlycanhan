@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/trangchu.css') }}">
@endsection

@section('content')

<div class="main-content">
    <div class="header">
        <h1>Good Morning, {{ Auth::user()->name ?? 'Khách' }}</h1>
    </div>

    <div class="calendar">
        <header>
            <h3></h3>
            <nav>
                <button id="prev"></button>
                <button id="next"></button>
            </nav>
        </header>
        <section>
            <ul class="days">
                <li>Chủ Nhật</li>
                <li>Thứ 2</li>
                <li>Thứ 3</li>
                <li>Thứ 4</li>
                <li>Thứ 5</li>
                <li>Thứ 6</li>
                <li>Thứ 7</li>
            </ul>
            <ul class="dates"></ul>
        </section>
    </div>

    <div class="tab-container">
        <div class="tabs">
            <div class="tab active" data-tab="todo">To-do</div>
            <div class="tab" data-tab="habit">Thói quen</div>
        </div>

        <div class="tab-content" id="todo-content">
            @foreach ($tasksByDay as $day => $tasks)
                <div class="day-column">
                    <h3 class="day-title">{{ $day }}</h3>
                    <ul class="task-list">
                        @foreach ($tasks as $task)
                            <li class="task-item">
                                <input type="checkbox" class="task-checkbox" 
                                    {{ $task->is_completed ? 'checked' : '' }}>
                                <span class="{{ $task->is_completed ? 'task-completed' : 'task-pending' }}">
                                    {{ $task->task_name }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="tab-content hidden" id="habit-content">
            <table class="habit-table">
                <ul class="list">
                    @foreach ($habits as $habit)
                        <li>{{ $habit->habit_name }}</li>
                    @endforeach
                </ul>

                @foreach ($habitTrackingsByWeek as $week => $trackings)
                    <div class="checkbox-1">
                        <span>Tuần {{ $week }}</span>
                        <ul class="check">
                            @foreach ($trackings as $tracking)
                                <li>
                                    @foreach ($tracking as $dayCompleted)
                                        <input type="checkbox" {{ $dayCompleted ? 'checked' : '' }}>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/trangchu.js') }}"></script>
@endsection
