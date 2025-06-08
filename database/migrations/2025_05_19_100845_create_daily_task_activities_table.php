<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_task_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId("daily_task_id")->constrained("daily_task")->onDelete("cascade");
            $table->foreignId("activity_id")->constrained("activity")->onDelete("cascade");
            $table->integer("understanding")->nullable();
            $table->integer("participation")->nullable();
            $table->text("notes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_task_activities');
    }
};
