<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panels extends Model
{
    public function panelContents()
    {
        return $this->hasMany(\App\Models\PanelsContent::class, 'id_panels', 'id');
    }

    /** @use HasFactory<\Database\Factories\PanelsFactory> */
    use HasFactory;

    protected $table = "panels";

    protected $fillable = [
        "id_pages",
        "panels_number",
    ];

    // many to one from panels to pages
    public function pages()
    {
        return $this->belongsTo(Pages::class, "id_pages", "id");
    }

    // one to many from panels to panels_content
    public function panels_content()
    {
        return $this->hasMany(PanelsContent::class, "id_panels", "id");
    }
}
