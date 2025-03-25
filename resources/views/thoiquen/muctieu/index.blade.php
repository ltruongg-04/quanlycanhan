@extends('layouts.app')

@section('title', 'Mục tiêu')

@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/css/muctieu-thoiquen.css') }}">
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
                <div class="month" onclick="selectMonth(this)">Tháng {{ $month }}</div>
            @endforeach
        </div>
    </div>

    <div class="content">
        <div class="left">
            <div class="goal-box">
                <h3>Mục tiêu của tháng</h3>
                <ul>
                    @foreach ($goals as $goal)
                        <li>
                            {{ $goal->name }} {{ $goal->count }}/{{ $goal->target_days }} ngày
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="goal-progress-container">
                <h3>Tiến độ chi tiết</h3>
                @foreach ($goals as $goal)
                    <div class="goal-progress-row">
                        <div class="goal-name">{{ $goal->name }}</div>
                        <div class="progress-bar-container">
                            <div class="progress-bar" style="width: {{ ($goal->completed_days / $goal->target_days) * 100 }}%;"></div>
                        </div>
                        <div class="goal-count">{{ $goal->completed_days }}/{{ $goal->target_days }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="right">
            <button class="btn new"><a href="{{ route('muc-tieu.create') }}">
                <i class="fa-solid fa-plus"></i> Thêm mới
            </a>
        </button>
            <button class="btn edit" onclick="openEditModal()">
                <i class="fa-solid fa-pen"></i> Chỉnh sửa
            </button>
        </div>
    </div>
</div>

<div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Chọn mục tiêu để chỉnh sửa</h2>
        <ul>
            @foreach ($goals as $goal)
                <li>
                    <a href="{{ route('muc-tieu.edit', $goal->id) }}" class="goal-link">
                        {{ $goal->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <button onclick="closeEditModal()">Hủy</button>
    </div>
</div>
<script>
    function openEditModal() {
        document.getElementById("editModal").style.display = "block";
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    window.onclick = function(event) {
        var modal = document.getElementById("editModal");
        if (event.target === modal) {
            closeEditModal();
        }
    }
</script>

<script src="{{ asset('frontend/js/muctieu-thoiquen.js') }}"></script>
@endsection
