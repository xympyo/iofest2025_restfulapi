<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /** @use HasFactory<\Database\Factories\LanguageFactory> */
    use HasFactory;

    protected $table = "language";

    protected $fillable = [
        "languages",
    ];

    // one to one from language to storybook
    public function storybook()
    {
        return $this->hasOne(Storybook::class, "id_language", "id");
    }
}
