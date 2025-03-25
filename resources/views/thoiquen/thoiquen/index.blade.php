@extends('layouts.app')

@section('title', 'Thói quen')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/thoiquen.css') }}">
@endsection

@section('content')
@php
    $daysInMonth = now()->daysInMonth;
    $month = now()->month;
    $year = now()->year;

    $leftHabits = $habits->filter(fn($habit, $index) => $index % 2 === 0);
    $rightHabits = $habits->filter(fn($habit, $index) => $index % 2 !== 0);
@endphp

<div class="main-content">
    <div class="header">
        <h1>Good Morning, {{ Auth::user()->name ?? 'Khách' }}</h1>
    </div>

    <div class="calendar">
        <div class="year-selector" id="yearDisplay"></div>
        <div class="months">
            @for ($i = 1; $i <= 12; $i++)
                <div class="month" onclick="selectMonth(this)">Tháng {{ $i }}</div>
            @endfor
        </div>
    </div>
    <div class="content-container">
        <div class="left-content">
            <div class="habit-container">
                <div class="habit-column" id="left-column">
                    @foreach ($leftHabits as $habit)
                        <div class="habit-tracker" data-habit="{{ $habit->id }}">
                            <h3>{{ $habit->habit_name }}</h3>
                            <div class="habit-grid">
                                @php
                                    $completedDates = isset($habitTrackings[$habit->id]) ? collect($habitTrackings[$habit->id]) : collect();
                                @endphp
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    @php
                                        $date = \Carbon\Carbon::create($year, $month, $day)->toDateString();
                                        $completed = $completedDates->where('tracking_date', $date)->where('is_completed', 1)->isNotEmpty();
                                    @endphp
                                    <div class="habit-day {{ $completed ? 'completed' : '' }}" 
                                        data-date="{{ $date }}" 
                                        data-habit="{{ $habit->id }}" 
                                        onclick="toggleHabitCompletion(this)">
                                        {{ $day }}
                                    </div>
                                @endfor
                            </div>
                            
                        </div>
                    @endforeach
                </div>
    
                <div class="habit-column" id="right-column">
                    @foreach ($rightHabits as $habit)
                        <div class="habit-tracker" data-habit="{{ $habit->id }}">
                            <h3>{{ $habit->habit_name }}</h3>
                            <div class="habit-grid">
                                @php
                                    $completedDates = isset($habitTrackings[$habit->id]) ? collect($habitTrackings[$habit->id]) : collect();
                                @endphp
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    @php
                                        $date = \Carbon\Carbon::create($year, $month, $day)->toDateString();
                                        $completed = $completedDates->where('tracking_date', $date)->where('is_completed', 1)->isNotEmpty();
                                    @endphp
                                    <div class="habit-day {{ $completed ? 'completed' : '' }}" 
                                        data-date="{{ $date }}" 
                                        data-habit="{{ $habit->id }}" 
                                        onclick="toggleHabitCompletion(this)">
                                        {{ $day }}
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <canvas id="habitChart"></canvas>
        </div>  
   </div>
   
    

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('frontend/js/thoiquen.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.habit-day').forEach(day => {
    day.addEventListener('click', function () {
        let habitId = this.getAttribute('data-habit');
        let trackingDate = this.getAttribute('data-date');

        console.log("Gửi request với:", { habit_id: habitId, tracking_date: trackingDate });

        fetch('/update-tracking-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ habit_id: habitId, tracking_date: trackingDate })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Kết quả API:", data);
            if (data.completed) {
                this.classList.add('completed'); 
            } else {
                this.classList.remove('completed'); 
            }
        })
        .catch(error => console.error('Lỗi:', error));
    });
    
    });

    
});

    </script>
    
@endsection
