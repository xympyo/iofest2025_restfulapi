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
}
