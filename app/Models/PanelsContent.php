<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelsContent extends Model
{
    /** @use HasFactory<\Database\Factories\PanelsContentFactory> */
    use HasFactory;

    protected $table = "panels_content";

    protected $fillable = [
        "id_panels",
        "image",
        "text",
        "text_align",
    ];

    // many to one from panels_content to panels
    public function panels()
    {
        return $this->belongsTo(Panels::class, "id_panels", "id");
    }
}
