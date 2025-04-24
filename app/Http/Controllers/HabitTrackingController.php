<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HabitTracking;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HabitTrackingController extends Controller
{
    
    public function toggleTracking(Request $request)
{
    $request->validate([
        'habit_id' => 'required|exists:habits,id',
        'tracking_date' => 'required|date',
    ]);

    $tracking = HabitTracking::where('habit_id', $request->habit_id)
                 ->where('tracking_date', $request->tracking_date)
                 ->first();

    if ($tracking) {
        $tracking->delete(); 
        return response()->json([
            'status' => 'success',
            'action' => 'deleted',
            'tracking_id' => null
        ]);
    } else {
        $newTracking = HabitTracking::create([
            'habit_id' => $request->habit_id,
            'tracking_date' => $request->tracking_date
        ]);

        return response()->json([
            'status' => 'success',
            'action' => 'added',
            'tracking_id' => $newTracking->id
        ]);
    }
}


    public function getTrackingStatus(Request $request)
    {
        $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'tracking_date' => 'required|date',
        ]);

        $completed = HabitTracking::where('habit_id', $request->habit_id)
        ->whereDate('tracking_date', $request->tracking_date) 
        ->value('is_completed'); 


        return response()->json(['completed' => $completed]);
    }

    public function getStats()
    {
        try {
            $userId = Auth::id();
            $stats = HabitTracking::join('habits', 'habit_trackings.habit_id', '=', 'habits.id')
                        ->join('goals', 'habits.goal_id', '=', 'goals.id')
                        ->where('habits.user_id', $userId)
                        ->selectRaw('goals.name as goal, COUNT(*) as count')
                        ->groupBy('goals.name')
                        ->get();

            return response()->json([
                'labels' => $stats->isEmpty() ? [] : $stats->pluck('goal'),
                'data' => $stats->isEmpty() ? [] : $stats->pluck('count')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Lỗi khi lấy dữ liệu',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'tracking_date' => 'required|date',
        ]);

        $habitTracking = HabitTracking::firstOrCreate(
            ['habit_id' => $request->habit_id, 'tracking_date' => $request->tracking_date]
        );

        $habit = Habit::find($request->habit_id);
        $goal = $habit ? $habit->goal : null;

        if ($goal) {
            $completedDays = HabitTracking::whereHas('habit', function ($query) use ($goal) {
                $query->where('goal_id', $goal->id);
            })->select('tracking_date')->distinct()->count();

            $goal->update(['completed_days' => $completedDays]);
        }

        return response()->json(['message' => 'Habit tracking saved successfully!']);
    }

    public function getHabitStats()
    {
        $userId = Auth::id();
        $habits = Habit::where('user_id', $userId)->with('habitTrackings')->get();

        $labels = [];
        $data = [];

        foreach ($habits as $habit) {
            $completedCount = $habit->habitTrackings()->count();
            $labels[] = $habit->habit_name;
            $data[] = $completedCount;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
    public function updateTrackingStatus(Request $request)
{
    \Log::info(" Dữ liệu request nhận được:", $request->all()); 
    $request->validate([
        'habit_id' => 'required|exists:habits,id',
        'tracking_date' => 'required|date',
    ]);

    $tracking = HabitTracking::where('habit_id', $request->habit_id)
                    ->where('tracking_date', $request->tracking_date)
                    ->first();

    if ($tracking) {
       
        $tracking->is_completed = !$tracking->is_completed;
        $tracking->save();

        \Log::info(" Cập nhật thành công:", ['completed' => $tracking->is_completed]);
    } else {
        $tracking = HabitTracking::create([
            'habit_id' => $request->habit_id,
            'tracking_date' => $request->tracking_date,
            'is_completed' => 1
        ]);

        \Log::info(" Tạo mới tracking:", ['completed' => $tracking->is_completed]);
    }

    return response()->json([
        'completed' => $tracking->is_completed
    ]);
}

    
}
