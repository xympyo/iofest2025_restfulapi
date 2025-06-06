<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTaskActivity extends Model
{
    /** @use HasFactory<\Database\Factories\DailyTaskActivityFactory> */
    use HasFactory;

    protected $table = "daily_task_activity";

    protected $fillable = [
        "daily_task_id",
        "activity_id",
        "is_completed",
        "completed_at",
    ];

    // Relationships
    public function dailyTask()
    {
        return $this->belongsTo(DailyTask::class, 'daily_task_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeIncomplete($query)
    {
        return $query->where('is_completed', false);
    }
}
