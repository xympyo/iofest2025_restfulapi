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
        Schema::create('panels_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_panels")->constrained("panels")->onDelete("cascade");
            $table->string("image");
            $table->string("text");
            $table->string("text_align");
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
