<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    /** @use HasFactory<\Database\Factories\PagesFactory> */
    use HasFactory;

    protected $table = "pages";

    protected $fillable = [
        "storybook_id",
    ];

    // many to one from pages to storybook
    public function storybook()
    {
        return $this->belongsTo(Storybook::class, "storybook_id", "id");
    }

    // one to many from pages to panels
    public function panels()
    {
        return $this->hasMany(Panels::class, "id_pages", "id");
    }
}
