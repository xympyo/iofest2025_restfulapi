<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Genre;

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
        return $this->belongsToMany(User::class, "creators", "id_storybook", "id_user");
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
    // Each storybook has many ratings from users
    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class, 'id_storybook', 'id');
    }


    // many-to-many with genres
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_storybook', 'storybook_id', 'genre_id');
    }

    // one to many from storybook to pages
    public function pages()
    {
        return $this->hasMany(Pages::class, "storybook_id", "id");
    }
}
