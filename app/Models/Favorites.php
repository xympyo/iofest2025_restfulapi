<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites extends Model
{
    /** @use HasFactory<\Database\Factories\FavoritesFactory> */
    use HasFactory;

    protected $table = "favorites";

    protected $fillable = [
        "id_user",
        "id_storybook",
    ];

    // PIVOT TABLE
}
