<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    protected $table = "activity";

    protected $fillable = [
        "title",
        "activity_category_id",
        "description",
        "duration_minutes",
    ];
}
