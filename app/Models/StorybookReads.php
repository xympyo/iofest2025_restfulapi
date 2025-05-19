<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorybookReads extends Model
{
    /** @use HasFactory<\Database\Factories\StorybookReadsFactory> */
    use HasFactory;

    protected $table = "storybook_reads";

    protected $fillable = [
        "id_user",
        "id_storybook",
    ];

    // many to one from storybook_reads to daily_task
    public function daily_task()
    {
        return $this->belongsTo(DailyTask::class, "id_daily_task", "id");
    }

    // many to one from storybook_reads to user
    public function user()
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    // many to one from storybook_reads to storybook
    public function storybook()
    {
        return $this->belongsTo(Storybook::class, "id_storybook", "id");
    }
}
