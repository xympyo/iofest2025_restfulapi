<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storybook extends Model
{
    /** @use HasFactory<\Database\Factories\StorybookFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "storybook_words",
        "read_time",
        "read_count",
        "pages_number",
        "is_approved",
        "id_language"
    ];
}
