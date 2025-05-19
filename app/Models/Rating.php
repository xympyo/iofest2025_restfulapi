<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $table = "rating";

    protected $fillable = [
        "id_user",
        "id_storybook",
        "rating",
        "comments",
    ];

    // PIVOT TABLE
}
