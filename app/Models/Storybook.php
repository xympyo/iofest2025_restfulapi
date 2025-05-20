<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storybook extends Model
{
    /** @use HasFactory<\Database\Factories\StorybookFactory> */
    use HasFactory;

    protected $table = "storybooks";

    protected $fillable = [
        "title",
        "description",
        "storybook_words",
        "read_time",
        "read_count",
        "pages_number",
        "is_approved",
        "id_language",
        "background_image",
        "storybook_profile",
    ];

    // one to many from storybook to user with pivot table creators
    public function get_creators()
    {
        return $this->belongsToMany(User::class, "creators", "id_storybook", "id_user")
            ->using(Creators::class);
    }

    // one to many from storybook to daily_task
    public function storybook_reads()
    {
        return $this->hasMany(StorybookReads::class, "id_storybook", "id");
    }

    // one to many from storybook to user with pivot table favorites
    public function get_favorite_report()
    {
        return $this->belongsToMany(User::class, "favorites", "id_storybook", "id_user")
            ->using(Favorites::class);
    }

    // one to many from storybook to user with pivot table rating
    public function get_rating_report()
    {
        return $this->belongsToMany(User::class, "rating", "id_storybook", "id_user")
            ->using(Rating::class)
            ->withPivot(['rating', 'comments']);
    }

    // one to many from storybook to pages
    public function pages()
    {
        return $this->hasMany(Pages::class, "storybook_id", "id");
    }
}
