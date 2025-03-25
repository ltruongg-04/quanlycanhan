<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Habit;
use App\Models\HabitTracking;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $userId = Auth::id();

        $tasks = Task::where('user_id', $userId)
                     ->orderBy('task_date', 'asc')
                     ->get()
                     ->groupBy(function($task) {
                         return Carbon::parse($task->task_date)->translatedFormat('l'); 
                     });

        $habits = Habit::where('user_id', $userId)->get();

        $habitTrackings = HabitTracking::whereIn('habit_id', $habits->pluck('id'))
                                       ->get()
                                       ->groupBy(function($tracking) {
                                           return Carbon::parse($tracking->tracking_date)->weekOfYear;
                                       });

        $habitTrackingsByWeek = [];
        foreach ($habitTrackings as $week => $trackings) {
            foreach ($habits as $habit) {
                $habitTrackingsByWeek[$week][$habit->habit_name] = [];
                for ($i = 0; $i < 7; $i++) {
                    $date = Carbon::now()->startOfWeek()->addDays($i);
                    $isCompleted = $trackings->where('habit_id', $habit->id)
                                             ->where('tracking_date', $date->toDateString())
                                             ->isNotEmpty(); 
                    $habitTrackingsByWeek[$week][$habit->habit_name][] = $isCompleted;
                }
            }
        }

        return view('home', [
            'tasksByDay' => $tasks,
            'habits' => $habits,
            'habitTrackingsByWeek' => $habitTrackingsByWeek
        ]);
    }
}
