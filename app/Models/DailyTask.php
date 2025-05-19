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

    // one to many from daily_task to activity with pivot daily_task_activity
    public function activitiesDone()
    {
        return $this->belongsToMany(Activity::class, "daily_task_activity", "daily_task_id", "activity_id")
            ->using(DailyTaskActivity::class);
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
