<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'goal_id', 'habit_name', 'target_days', 'completed_days'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function habitTrackings()
{
    return $this->hasMany(HabitTracking::class, 'habit_id');
}


    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
