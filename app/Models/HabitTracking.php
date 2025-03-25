<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitTracking extends Model
{
    use HasFactory;

    protected $table = 'habit_trackings'; 

    protected $fillable = ['habit_id', 'tracking_date', 'is_completed', 'count'];


    protected $casts = [
        'tracking_date' => 'date',
    ];

    public function habit()
    {
        return $this->belongsTo(Habit::class, 'habit_id');
    }
}
