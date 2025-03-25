<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TasksSeeder extends Seeder
{
    public function run()
    {
        $userId = DB::table('users')->first()->id ?? 1;

        $now = Carbon::create(Carbon::now()->year, 4, 1);
        $startOfWeek = $now->copy()->startOfWeek(); 
        $tasks = [];

        $tasks[] = ['user_id' => $userId, 'task_name' => 'Học thuộc 250 kanji', 'task_date' => $now->copy()->endOfMonth()->format('Y-m-d'), 'is_completed' => false, 'category' => 'month'];
        $tasks[] = ['user_id' => $userId, 'task_name' => 'Hoàn thành 12 unit', 'task_date' => $now->copy()->endOfMonth()->format('Y-m-d'), 'is_completed' => false, 'category' => 'month'];
        $tasks[] = ['user_id' => $userId, 'task_name' => 'Đọc xong 3 quyển sách', 'task_date' => $now->copy()->endOfMonth()->format('Y-m-d'), 'is_completed' => false, 'category' => 'month'];
        $tasks[] = ['user_id' => $userId, 'task_name' => 'Hoàn thành dự án', 'task_date' => $now->copy()->endOfMonth()->format('Y-m-d'), 'is_completed' => false, 'category' => 'month'];
        $tasks[] = ['user_id' => $userId, 'task_name' => 'Tiết kiệm 2 triệu', 'task_date' => $now->copy()->endOfMonth()->format('Y-m-d'), 'is_completed' => false, 'category' => 'month'];

        $weeklyGoals = [
            'Học thuộc 60 kanji',
            'Hoàn thành unit 3,4',
            'Hoàn thành task 1,2 dự án',
            'Viết CV'
        ];

        for ($weekNumber = 1; $startOfWeek->month == 4; $weekNumber++) {
            $endOfWeek = $startOfWeek->copy()->endOfWeek();
            foreach ($weeklyGoals as $goal) {
                $tasks[] = [
                    'user_id' => $userId,
                    'task_name' => $goal,
                    'task_date' => $endOfWeek->format('Y-m-d'),
                    'is_completed' => false,
                    'category' => 'week'
                ];
            }
            $startOfWeek->addWeek();
        }

        for ($day = 1; $day <= 30; $day++) {
            $taskDate = Carbon::create($now->year, 4, $day);
            $tasks[] = ['user_id' => $userId, 'task_name' => 'Ôn tập từ vựng', 'task_date' => $taskDate->format('Y-m-d'), 'is_completed' => false, 'category' => 'day'];
            $tasks[] = ['user_id' => $userId, 'task_name' => 'Giải đề thi thử', 'task_date' => $taskDate->format('Y-m-d'), 'is_completed' => false, 'category' => 'day'];
        }

        DB::table('tasks')->insert($tasks);
    }
}
