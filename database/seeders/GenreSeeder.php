<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Petualangan',
            'Fantasi',
            'Misteri',
            'Fiksi Ilmiah',
            'Nonfiksi',
            'Romansa',
            'Horor',
            'Komedi',
            'Edukasi',
            'Sejarah',
            'Puisi',
            'Biografi',
            'Dongeng',
            'Fabel',
            'Mitologi',
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
