<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('languages')->updateOrInsert(['id' => 1], ['languages' => 'English']);
        \DB::table('languages')->updateOrInsert(['id' => 2], ['languages' => 'Indonesia']);
    }
}
