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
        Schema::create('daily_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_user")->constrained("users")->onDelete("cascade");
            $table->foreignId("id_storybook_reads")->nullable()->constrained("storybook_reads");
            $table->integer("reading_time")->nullable();
            $table->integer("words_count")->nullable();
            $table->integer("cognitive_count")->nullable();
            $table->integer("sensory_count")->nullable();
            $table->integer("motor_count")->nullable();
            $table->integer("emotional_count")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_tasks');
    }
};
