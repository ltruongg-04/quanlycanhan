
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('target_days')->default(1);
            $table->integer('completed_days')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });
    }

    public function down() {
        Schema::dropIfExists('goals');
    }
};
