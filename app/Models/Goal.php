<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['user_id', 'name', 'target_days', 'completed_days'];

    public function habits()
    {
        return $this->hasMany(Habit::class, 'goal_id');
    }
}
