<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Habit;
use App\Models\HabitTracking;

class HabitController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $habits = Habit::where('user_id', $user->id)->orderBy('id')->get();

        $currentYear = now()->year;
        $currentMonth = now()->month;

        $habitTrackings = HabitTracking::whereYear('tracking_date', $currentYear)
    ->whereMonth('tracking_date', $currentMonth)
    ->whereIn('habit_id', $habits->pluck('id'))
    ->select('habit_id', 'tracking_date', 'is_completed')  
    ->get()
    ->groupBy('habit_id');


        $habitStats = [];
        foreach ($habits as $habit) {
            $habitStats[$habit->id] = $habitTrackings->has($habit->id) ? $habitTrackings[$habit->id]->count() : 0;
        }

        return view('thoiquen.thoiquen.index', compact('habits', 'habitTrackings', 'habitStats'));
    }

    public function create()
    {
        return view('thoiquen.thoiquen.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'habit_name' => 'required|string|max:255|unique:habits,habit_name,NULL,id,user_id,' . Auth::id(),
        ]);

        Habit::create([
            'user_id' => Auth::id(),
            'habit_name' => $request->input('habit_name'),
        ]);

        return redirect()->route('thoi-quen')->with('success', 'Thói quen đã được thêm!');
    }

    public function edit($id)
    {
        $habit = Habit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('thoiquen.thoiquen.edit', compact('habit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'habit_name' => 'required|string|max:255|unique:habits,habit_name,' . $id . ',id,user_id,' . Auth::id(),
        ]);

        $habit = Habit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->habit_name !== $habit->habit_name) {
            HabitTracking::where('habit_id', $habit->id)->update(['habit_name' => $request->habit_name]);
        }

        $habit->update([
            'habit_name' => $request->habit_name,
        ]);

        return redirect()->route('thoi-quen')->with('success', 'Thói quen đã được cập nhật!');
    }

    public function destroy($id)
    {
        $habit = Habit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        HabitTracking::where('habit_id', $habit->id)->delete();

        $habit->delete();

        return redirect()->route('thoi-quen')->with('success', 'Thói quen và dữ liệu liên quan đã được xóa!');
    }



}
