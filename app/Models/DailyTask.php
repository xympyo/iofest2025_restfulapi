<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    /** @use HasFactory<\Database\Factories\DailyTaskFactory> */
    use HasFactory;

    protected $table = "daily_task";

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

    // Relationship to DailyTaskActivity pivot records
    public function dailyTaskActivities()
    {
        return $this->hasMany(DailyTaskActivity::class, 'daily_task_id');
    }

    // Activities with completion info (many-to-many)
    public function activitiesDone()
    {
        return $this->belongsToMany(Activity::class, "daily_task_activity", "daily_task_id", "activity_id")
            ->using(DailyTaskActivity::class)
            ->withPivot(['is_completed', 'completed_at']);
    }

    // Helper: completed activities
    public function completedActivities()
    {
        return $this->activitiesDone()->wherePivot('is_completed', true);
    }

    // Helper: incomplete activities
    public function incompleteActivities()
    {
        return $this->activitiesDone()->wherePivot('is_completed', false);
    }

    // one to many from daily_task to storybook_reads
    public function storybook_reads()
    {
        return $this->hasMany(StorybookReads::class, "id_daily_task", "id");
    }

    // many to one from daily_task to user
    public function user()
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }
}
