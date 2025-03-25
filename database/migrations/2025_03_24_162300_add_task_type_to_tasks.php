<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('task_type', ['day', 'week', 'month', 'year'])->after('task_date')->default('day');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('task_type');
        });
    }
};

