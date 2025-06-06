<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // one to many from user to creators
    public function get_storybook()
    {
        return $this->belongsToMany(Storybook::class, "creators", "id_user", "id_storybook")
            ->using(Creators::class);
    }

    // one to many from user to daily_task
    public function daily_task()
    {
        return $this->hasMany(DailyTask::class, "id_user", "id");
    }

    // one to many from user to storybook with pivot favorites
    public function favoritedBooks()
    {
        return $this->belongsToMany(Storybook::class, "favorites", "id_user", "id_storybook")
            ->using(Favorites::class);
    }

    // one to many from user to storybook with pivot rating
    public function ratedBooks()
    {
        return $this->belongsToMany(Storybook::class, "rating", "id_user", "id_storybook")
            ->using(Rating::class)
            ->withPivot(['rating', 'comments']);
    }
}
