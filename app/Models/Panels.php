<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panels extends Model
{
    /** @use HasFactory<\Database\Factories\PanelsFactory> */
    use HasFactory;

    protected $table = "panels";

    protected $fillable = [
        "id_pages",
        "panels_number",
    ];
}
