<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('habits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('goal_id')->nullable()->constrained('goals')->onDelete('cascade');
            $table->string('habit_name');
            $table->timestamps();

            $table->unique(['user_id', 'habit_name']);
        });
        Schema::create('habit_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('habit_id')->constrained('habits')->onDelete('cascade');
            $table->date('tracking_date');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->unique(['habit_id', 'tracking_date']);
        });
    }

    public function down() {
        Schema::dropIfExists('habits');
        Schema::dropIfExists('habit_trackings');
        Schema::dropIfExists('goals');

    }
};
