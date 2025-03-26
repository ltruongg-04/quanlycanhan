<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
    $startDate = Carbon::now()->startOfWeek(); 
    $endDate = $startDate->copy()->addDays(6); 

    $tasks = Task::where('user_id', $userId)
        ->where('category', 'day')
        ->whereBetween('task_date', [$startDate->toDateString(), $endDate->toDateString()])
        ->orderBy('task_date', 'asc')
        ->get()
        ->groupBy(function ($task) {
            return Carbon::parse($task->task_date)->isoFormat('dddd'); 
        });

    return response()->json($tasks);
    }

    public function create()
    {
        return view('congviec.new');
    }

    public function store(Request $request)
    {
        Task::create($request->all());
        return redirect()->route('cong-viec')->with('success', 'Công việc đã được thêm!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('congviec.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return redirect()->route('cong-viec')->with('success', 'Công việc đã được cập nhật!');
    }

    public function destroy(string $id)
    {
        //
    }
    public function full()
    {
        $userId = auth()->id(); 
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();

        $yearlyGoals = Task::where('user_id', $userId)
            ->where('category', 'year')
            ->get();

        $monthlyGoals = Task::where('user_id', $userId)
            ->where('category', 'month')
            ->whereBetween('task_date', [$startOfMonth, $endOfMonth]) 
            ->get();

        $weeklyGoals = Task::where('user_id', $userId)
            ->where('category', 'week')
            ->whereBetween('task_date', [$startOfMonth, $endOfMonth])
            ->orderBy('task_date', 'asc')
            ->get()
            ->groupBy(function ($task) {
                $startOfWeek = Carbon::parse($task->task_date)->locale('vi')->startOfWeek(Carbon::MONDAY);
                $endOfWeek = Carbon::parse($task->task_date)->locale('vi')->endOfWeek(Carbon::SUNDAY);

                if ($endOfWeek->greaterThan(Carbon::parse($task->task_date)->endOfMonth())) {
                    $endOfWeek = Carbon::parse($task->task_date)->endOfMonth();
                }

                return "Mục tiêu của tuần (" . $startOfWeek->format('d/m') . " - " . $endOfWeek->format('d/m') . ")";
            });

    return view('congviec.index', compact('yearlyGoals', 'monthlyGoals', 'weeklyGoals'));


    }

    public function getTasksByMonth($month)
{
    $userId = auth()->id();

    $monthlyGoals = Task::where('user_id', $userId)
        ->where('category', 'month')
        ->whereMonth('task_date', $month)
        ->get();

    $weeklyGoals = Task::where('user_id', $userId)
        ->where('category', 'week')
        ->whereMonth('task_date', $month)
        ->orderBy('task_date', 'asc')
        ->get()
        ->groupBy(function ($task) {
            return "Mục tiêu của tuần (" . Carbon::parse($task->task_date)->format('d/m') . " - " .
                Carbon::parse($task->task_date)->endOfWeek()->format('d/m') . ")";
        });

    return response()->json([
        'monthlyGoals' => $monthlyGoals,
        'weeklyGoals' => $weeklyGoals,
    ]);
}

public function weeklyTasks()
{
    $userId = Auth::id(); 
    $startDate = Carbon::now()->startOfWeek(); 
    $endDate = $startDate->copy()->addDays(6); 

    $dailyTasks = Task::where('user_id', $userId)
        ->where('category', 'day')
        ->whereBetween('task_date', [$startDate->toDateString(), $endDate->toDateString()])
        ->orderBy('task_date', 'asc')
        ->get()
        ->groupBy(function ($task) {
            return Carbon::parse($task->task_date)->isoFormat('dddd, DD/MM'); 
        });

    $weeklyTasks = Task::where('user_id', $userId)
        ->where('category', 'week')
        ->whereBetween('task_date', [$startDate->toDateString(), $endDate->toDateString()])
        ->orderBy('task_date', 'asc')
        ->get();

    $sunday = Carbon::now()->next(Carbon::SUNDAY)->isoFormat('dddd, DD/MM');
    if (!$weeklyTasks->isEmpty()) {
        $dailyTasks[$sunday] = $weeklyTasks;
    }
    return view('congviec.congviectuan.index', compact('dailyTasks'));
}
}
