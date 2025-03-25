<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitTrackingSeeder extends Seeder
{
    public function run()
    {
        $habitTracking = [
            ['habit_id' => 1, 'tracking_date' => '2025-03-02', 'is_completed' => true],
            ['habit_id' => 1, 'tracking_date' => '2025-03-03', 'is_completed' => false],
            ['habit_id' => 1, 'tracking_date' => '2025-03-04', 'is_completed' => true],
            ['habit_id' => 1, 'tracking_date' => '2025-03-05', 'is_completed' => false],
            ['habit_id' => 1, 'tracking_date' => '2025-03-06', 'is_completed' => false],
            ['habit_id' => 1, 'tracking_date' => '2025-03-07', 'is_completed' => true],
            ['habit_id' => 1, 'tracking_date' => '2025-03-08', 'is_completed' => true],

            ['habit_id' => 2, 'tracking_date' => '2025-03-02', 'is_completed' => false],
            ['habit_id' => 2, 'tracking_date' => '2025-03-03', 'is_completed' => true],
            ['habit_id' => 2, 'tracking_date' => '2025-03-04', 'is_completed' => true],
            ['habit_id' => 2, 'tracking_date' => '2025-03-05', 'is_completed' => true],
            ['habit_id' => 2, 'tracking_date' => '2025-03-06', 'is_completed' => false],
            ['habit_id' => 2, 'tracking_date' => '2025-03-07', 'is_completed' => true],
            ['habit_id' => 2, 'tracking_date' => '2025-03-08', 'is_completed' => true],

            ['habit_id' => 3, 'tracking_date' => '2025-03-02', 'is_completed' => false],
            ['habit_id' => 3, 'tracking_date' => '2025-03-03', 'is_completed' => true],
            ['habit_id' => 3, 'tracking_date' => '2025-03-04', 'is_completed' => false],
            ['habit_id' => 3, 'tracking_date' => '2025-03-05', 'is_completed' => true],
            ['habit_id' => 3, 'tracking_date' => '2025-03-06', 'is_completed' => true],
            ['habit_id' => 3, 'tracking_date' => '2025-03-07', 'is_completed' => true],
            ['habit_id' => 3, 'tracking_date' => '2025-03-08', 'is_completed' => true],

            ['habit_id' => 4, 'tracking_date' => '2025-03-02', 'is_completed' => false],
            ['habit_id' => 4, 'tracking_date' => '2025-03-03', 'is_completed' => true],
            ['habit_id' => 4, 'tracking_date' => '2025-03-04', 'is_completed' => false],
            ['habit_id' => 4, 'tracking_date' => '2025-03-05', 'is_completed' => false],
            ['habit_id' => 4, 'tracking_date' => '2025-03-06', 'is_completed' => true],
            ['habit_id' => 4, 'tracking_date' => '2025-03-07', 'is_completed' => true],
            ['habit_id' => 4, 'tracking_date' => '2025-03-08', 'is_completed' => false],

            ['habit_id' => 1, 'tracking_date' => '2025-03-09', 'is_completed' => true],
            ['habit_id' => 2, 'tracking_date' => '2025-03-09', 'is_completed' => false],
            ['habit_id' => 3, 'tracking_date' => '2025-03-09', 'is_completed' => false],
            ['habit_id' => 4, 'tracking_date' => '2025-03-09', 'is_completed' => false],
        ];

        DB::table('habit_trackings')->insert($habitTracking);
    }
}
