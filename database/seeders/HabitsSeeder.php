<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitsSeeder extends Seeder
{
    public function run()
    {
        $userId = DB::table('users')->first()->id ?? 1;

        $goalId = DB::table('goals')->first()->id ?? null;

        if (!$goalId) {
            $goalId = DB::table('goals')->insertGetId([
                'user_id' => $userId,
                'name' => 'Goal Mặc Định',
                'target_days' => 30,
                'completed_days' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $habits = [
            ['user_id' => $userId, 'goal_id' => $goalId, 'habit_name' => 'Dậy sớm (trước 7h)'],
            ['user_id' => $userId, 'goal_id' => $goalId, 'habit_name' => 'Đọc sách (20 trang)'],
            ['user_id' => $userId, 'goal_id' => $goalId, 'habit_name' => 'Tập thể dục (20 phút)'],
            ['user_id' => $userId, 'goal_id' => $goalId, 'habit_name' => 'Ngủ sớm (trước 12h)'],
        ];

        DB::table('habits')->insert($habits);

        $createdHabits = DB::table('habits')->where('goal_id', $goalId)->get();

        foreach ($createdHabits as $habit) {
            for ($i = 0; $i < 30; $i++) { 
                DB::table('habit_trackings')->insert([
                    'habit_id' => $habit->id,
                    'tracking_date' => now()->addDays($i)->toDateString(),
                    'is_completed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
