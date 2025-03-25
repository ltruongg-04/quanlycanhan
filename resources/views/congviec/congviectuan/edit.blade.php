@extends('layouts.app')

@section('title', 'Công việc')

@section('content')
<div class="main-content">
    <div class="header">
        <h1>Good Morning, {{ Auth::user()->name ?? 'User' }}</h1>
    </div>

    <div class="calendar">
        <div class="year-selector" id="yearDisplay"></div>
        <div class="months">
            @for ($i = 1; $i <= 12; $i++)
                <div class="month" onclick="selectMonth(this)">Tháng {{ $i }}</div>
            @endfor
        </div>
    </div>

    <div class="content">
        <div class="goal">
            <nav>
                @php 
                    $tasks = [
                        'Thứ 2' => ['Học 10 từ mới', 'Nhận xét học sinh', 'Dọn phòng', 'Làm bài tập Unit 2'],
                        'Thứ 3' => ['Học 10 từ mới', 'Họp đồ án cơ sở', 'Giặt quần áo'],
                        'Thứ 4' => ['Học 10 từ mới', 'Họp đồ án cơ sở', 'Giặt quần áo'],
                        'Thứ 5' => ['Học 10 từ mới', 'Họp đồ án cơ sở', 'Giặt quần áo'],
                        'Thứ 6' => ['Học 10 từ mới', 'Họp đồ án cơ sở', 'Giặt quần áo'],
                        'Thứ 7' => [],
                        'Chủ nhật' => []
                    ];
                @endphp

                @foreach ($tasks as $day => $taskList)
                    <div class="goal-week">
                        <h3>{{ $day }}()</h3>
                        <ul>
                            @foreach ($taskList as $task)
                                <li><input type="checkbox"> {{ $task }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </nav>
        </div>

        <div class="chart">
            <div class="chart-container">
                <div class="y-axis">
                    @for ($i = 5; $i >= 1; $i--)
                        <div class="y-label">{{ $i }}</div>
                    @endfor
                </div>
                <div class="chart-bars">
                    @php 
                        $barHeights = [20, 60, 40, 0, 0, 0, 0]; 
                    @endphp
                    @foreach ($barHeights as $height)
                        <div class="bar" style="height: {{ $height }}%;"></div>
                    @endforeach
                </div>
            </div>

            <div class="progress-section">
                <div class="progress-row">
                    <div class="progress-label">Hoàn thành</div>
                    <div class="progress-bar">
                        @for ($i = 1; $i <= 7; $i++)
                            <div class="progress-unit {{ $i <= 3 ? 'filled' : '' }}">{{ $i <= 3 ? 3 : '' }}</div>
                        @endfor
                    </div>
                </div>
                <div class="progress-row">
                    <div class="progress-label">Tổng công việc</div>
                    <div class="progress-bar">
                        @for ($i = 1; $i <= 7; $i++)
                            <div class="progress-unit {{ $i <= 3 ? 'filled' : '' }}">{{ $i <= 3 ? 4 : '' }}</div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn">
        <button class="back">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </button>
        <button class="save">
            <i class="fa-solid fa-download"></i> Lưu
        </button>
    </div>
</div>

<script src="{{ asset('frontend/js/chinhsuatheotuan.js') }}"></script>
@endsection
