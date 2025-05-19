<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creators extends Model
{
    /** @use HasFactory<\Database\Factories\CreatorsFactory> */
    use HasFactory;

    protected $table = "creators";

    protected $fillable = [
        "id_user",
        "id_storybook",
    ];

    // PIVOT TABLE
}
