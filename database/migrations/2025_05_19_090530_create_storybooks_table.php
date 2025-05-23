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
        Schema::create('storybooks', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->integer("storybook_words");
            $table->integer("read_time");
            $table->integer("read_count")->default(0);
            $table->integer("pages_number");
            $table->integer("is_approved")->default(0);
            $table->foreignId("id_language")->constrained("languages")->default(1);
            $table->string("background_image")->nullable();
            $table->string("storybook_profile");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storybooks');
    }
};
