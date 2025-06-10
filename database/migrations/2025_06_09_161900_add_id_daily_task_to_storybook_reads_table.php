<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('storybook_reads', function (Blueprint $table) {
            $table->unsignedBigInteger('id_daily_task')->nullable()->after('id_storybook');
            $table->foreign('id_daily_task')->references('id')->on('daily_task')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('storybook_reads', function (Blueprint $table) {
            $table->dropForeign(['id_daily_task']);
            $table->dropColumn('id_daily_task');
        });
    }
};
