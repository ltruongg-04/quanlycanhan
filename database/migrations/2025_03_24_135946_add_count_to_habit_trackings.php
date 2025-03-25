<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('habit_trackings', function (Blueprint $table) {
            $table->integer('count')->default(0); 
        });
    }

    public function down() {
        Schema::table('habit_trackings', function (Blueprint $table) {
            $table->dropColumn('count');
        });
    }
};

