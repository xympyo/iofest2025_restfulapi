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
        Schema::create('panels_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_panels")->constrained("panels")->onDelete("cascade");
            $table->string("image");
            $table->string("top_text")->nullable();
            $table->string("top_text_align")->nullable();
            $table->string("middle_text")->nullable();
            $table->string("middle_text_align")->nullable();
            $table->string("bottom_text")->nullable();
            $table->string("bottom_text_align")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panels_contents');
    }
};
