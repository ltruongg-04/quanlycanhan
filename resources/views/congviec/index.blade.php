@extends('layouts.app')

@section('title', 'Công việc')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/congviec.css') }}">
@endsection

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Good Morning, {{ Auth::user()->name ?? 'Khách' }}</h1>
    </div>

    <div class="calendar">
        <div class="year-selector" id="yearDisplay"></div>
        <div class="months">
            @foreach(range(1, 12) as $month)
                <div class="month" onclick="selectMonth(this, {{ $month }})">Tháng {{ $month }}</div>
            @endforeach
        </div>
        
    </div>

    <div class="content">
        <div class="goal" id="goal-content">
            <nav>
                <div class="goal-year">
                    <h3>Mục tiêu của năm</h3>
                    <ul id="yearlyGoals">
                        @foreach ($yearlyGoals as $goal)
                            <li>
                                {{ $goal->task_name }}
                                <a href="{{ route('cong-viec.edit', $goal->id) }}" class="edit-btn">
                                    <i class="fa-solid fa-pen"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="goal-month">
                    <h3>Mục tiêu của tháng</h3>
                    <ul id="monthlyGoals">
                        @foreach ($monthlyGoals as $goal)
                            <li>
                                {{ $goal->task_name }}
                                <a href="{{ route('cong-viec.edit', $goal->id) }}" class="edit-btn">
                                    <i class="fa-solid fa-pen"></i> 
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            
            <nav id="weeklyGoals">
                @foreach ($weeklyGoals as $weekLabel => $tasks)
                    <div class="goal-week">
                        <a href="{{ route('cong-viec.tuan') }}">
                            <h3>{{ $weekLabel }}</h3>
                        </a>                        
                        <ul>
                            @foreach ($tasks as $task)
                                <li>
                                    {{ $task->task_name }}
                                    <a href="{{ route('cong-viec.edit', $task->id) }}" class="edit-btn">
                                        <i class="fa-solid fa-pen"></i> 
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                </nav>
                
            </div>
    
            <div class="btn">
                <button class="new">
                <a href="{{ route('cong-viec.create') }}" >
                    <i class="fa-solid fa-plus"></i> Thêm mới
                </a>
                </button>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('frontend/js/congviec.js') }}"></script>
    

<script>
    
</script>
@endsection
