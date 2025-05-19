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
        Schema::create('storybook_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_user")->constrained("users")->onDelete("cascade");
            $table->foreignId("id_storybook")->constrained("storybooks")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storybook_reads');
    }
};
