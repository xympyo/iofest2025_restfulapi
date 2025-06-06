<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelsContent extends Model
{
    public function panel()
    {
        return $this->belongsTo(\App\Models\Panels::class, 'id_panels', 'id');
    }

    /** @use HasFactory<\Database\Factories\PanelsContentFactory> */
    use HasFactory;

    protected $table = "panels_content";

    protected $fillable = [
        "id_panels",
        "image",
        "top_text",
        "top_text_align",
        "middle_text",
        "middle_text_align",
        "bottom_text",
        "bottom_text_align",
    ];

    // many to one from panels_content to panels
    public function panels()
    {
        return $this->belongsTo(Panels::class, "id_panels", "id");
    }
}
