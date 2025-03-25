<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use App\Models\Habit;
use App\Models\HabitTracking;
use Carbon\Carbon;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        return view('thoiquen.muctieu.index', compact('goals'));
    }

    public function create()
    {
        return view('thoiquen.muctieu.new');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'target_days' => 'required|integer|min:1|max:31',
    ]);

    $goal = Goal::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'target_days' => $request->target_days,
        'completed_days' => 0
    ]);

    $habit = Habit::create([
        'user_id' => auth()->id(),
        'habit_name' => $goal->name,
        'goal_id' => $goal->id
    ]);

    $startDate = Carbon::now()->startOfMonth(); 
    for ($i = 0; $i < $goal->target_days; $i++) {
        HabitTracking::create([
            'habit_id' => $habit->id,
            'tracking_date' => $startDate->copy()->addDays($i)->toDateString(),
            'is_completed' => false
        ]);
    }
    

    return redirect()->route('muc-tieu')->with('success', 'Mục tiêu, thói quen và lịch theo dõi đã được tạo!');
}


    public function edit($id)
    {
        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('thoiquen.muctieu.edit', compact('goal'));
    }

    public function update(Request $request,Habit $habit, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:goals,name,' . $id . ',id,user_id,' . Auth::id(),
            'completed_days' => 'required|integer|min:0',
            'target_days' => 'required|integer|min:1|max:31',
        ]);

        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $goal->update([
            'name' => $request->name,
            'completed_days' => $request->completed_days,
            'target_days' => $request->target_days,
        ]);

        Habit::where('goal_id', $goal->id)->update([
            'habit_name' => $request->name, 
        ]);
        $targetDays = (int) $request->target_days;
        $startDate = Carbon::parse($request->tracking_date); 

        $startDate = Carbon::now()->startOfMonth();
        $targetDays = (int) $request->target_days;

        HabitTracking::where('habit_id', $habit->id)->delete();

        for ($i = 0; $i < $targetDays; $i++) {
            HabitTracking::create([
                'habit_id' => $habit->id,
                'tracking_date' => $startDate->copy()->addDays($i)->toDateString(),
                'is_completed' => false
            ]);
        }


        return redirect()->route('muc-tieu')->with('success', 'Mục tiêu và thói quen đã được cập nhật!');
    }

    public function destroy($id)
{
    $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    $habits = Habit::where('goal_id', $goal->id)->get();

    foreach ($habits as $habit) {
        HabitTracking::where('habit_id', $habit->id)->delete();
        $habit->delete();
    }

    $goal->delete();
    return redirect()->route('muc-tieu')->with('success', 'Mục tiêu và các dữ liệu liên quan đã bị xóa!');
}

public function markHabitCompleted(Request $request, $tracking_id) {
    $habitTracking = HabitTracking::findOrFail($tracking_id);
    $habitTracking->is_completed = true;
    $habitTracking->count += 1; 
    $habitTracking->save();

    $goal = Goal::whereHas('habits', function ($query) use ($habitTracking) {
        $query->where('id', $habitTracking->habit_id);
    })->first();

    if ($goal) {
        $goal->completed_days = HabitTracking::where('habit_id', $habitTracking->habit_id)
            ->where('is_completed', true)
            ->count();
        $goal->save();
    }

    return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
}

public function toggleHabitTracking(Request $request) {
    $request->validate([
        'habit_id' => 'required|exists:habits,id',
        'tracking_date' => 'required|date',
    ]);

    $habitTracking = HabitTracking::where('habit_id', $request->habit_id)
        ->where('tracking_date', $request->tracking_date)
        ->first();

    if ($habitTracking) {
        $habitTracking->is_completed = !$habitTracking->is_completed;
        $habitTracking->save();
    } else {
        HabitTracking::create([
            'habit_id' => $request->habit_id,
            'tracking_date' => $request->tracking_date,
            'is_completed' => true,
        ]);
    }

    return response()->json(['success' => true]);
}

}
