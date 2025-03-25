@extends('layouts.app')

@section('title', 'Công việc trong tuần')
@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/congviectheotuan.css') }}">
@endsection

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Good Morning, {{ Auth::user()->name ?? 'User' }}</h1>
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
        <div class="goal">
            @php
                $daysOfWeek = [
                    'Monday' => 'Thứ Hai',
                    'Tuesday' => 'Thứ Ba',
                    'Wednesday' => 'Thứ Tư',
                    'Thursday' => 'Thứ Năm',
                    'Friday' => 'Thứ Sáu',
                    'Saturday' => 'Thứ Bảy',
                    'Sunday' => 'Chủ Nhật',
                ];
            @endphp

            @foreach ($dailyTasks as $day => $tasks)
                @php
                    $parts = explode(', ', $day); 
                    $dayName = $daysOfWeek[$parts[0]] ?? $parts[0]; 
                    $formattedDate = $dayName . ', ' . ($parts[1] ?? '');
                @endphp
                <div class="goal-week">
                    <h3>{{ $formattedDate }}</h3>
                    @if ($tasks->isEmpty())
                        <p>Không có công việc nào.</p>
                    @else
                        <ul>
                            @foreach ($tasks as $task)
                                <li><input type="checkbox"> {{ $task->task_name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
    
</div>

<script>
   

function selectMonth(element) {
    document.querySelectorAll('.month').forEach(month => month.classList.remove('selected'));
    element.classList.add('selected');
}


function autoSelectCurrentMonthYear() {
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth(); 

    document.getElementById("yearDisplay").textContent = currentYear;
    let months = document.querySelectorAll('.month');
    months[currentMonth].classList.add('selected');
}

window.onload = autoSelectCurrentMonthYear;

</script>

@endsection
