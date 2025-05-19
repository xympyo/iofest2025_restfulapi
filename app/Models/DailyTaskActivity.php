<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTaskActivity extends Model
{
    /** @use HasFactory<\Database\Factories\DailyTaskActivityFactory> */
    use HasFactory;

    protected $fillable = [
        "daily_task_id",
        "activity_id",
    ];
}
