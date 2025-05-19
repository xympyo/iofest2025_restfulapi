<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    /** @use HasFactory<\Database\Factories\DailyTaskFactory> */
    use HasFactory;

    protected $fillable = [
        "id_user",
        "id_storybook_reads",
        "reading_time",
        "words_count",
        "cognitive_count",
        "sensory_count",
        "motor_count",
        "emotional_count",
    ];
}
