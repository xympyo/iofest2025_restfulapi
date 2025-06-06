<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $table = 'activity_category';
    /** @use HasFactory<\Database\Factories\ActivityCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        "category",
    ];

    // many to one from activity_category to activity
    public function activity()
    {
        return $this->hasMany(Activity::class, "activity_category_id", "id");
    }
}
