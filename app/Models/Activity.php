<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    protected $fillable = [
        "title",
        "activity_category_id",
        "description",
        "duration_minutes",
    ];

    // one to one from activity to daily_task_activity
    public function daily_task_activity()
    {
        return $this->hasMany(DailyTaskActivity::class, "activity_id", "id");
    }

    // one to many from activity to activity_category
    public function activity_category()
    {
        return $this->belongsTo(ActivityCategory::class, "activity_category_id", "id");
    }
}
