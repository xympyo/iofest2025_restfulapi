<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelsContent extends Model
{
    /** @use HasFactory<\Database\Factories\PanelsContentFactory> */
    use HasFactory;

    protected $fillable = [
        "id_panels",
        "image",
        "text",
        "text_align",
    ];
}
