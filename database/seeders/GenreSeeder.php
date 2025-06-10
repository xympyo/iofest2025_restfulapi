<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Adventure',
            'Fantasy',
            'Mystery',
            'Science Fiction',
            'Non-fiction',
            'Romance',
            'Horror',
            'Comedy',
            'Educational',
            'Historical',
            'Poetry',
            'Biography',
            'Fairy Tale',
            'Fable',
            'Mythology',
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'genre_name' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
