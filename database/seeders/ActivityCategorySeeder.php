<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Kognitif',
            'Sensorik',
            'Motorik',
            'Emosional',
        ];

        foreach ($categories as $category) {
            DB::table('activity_category')->insert([
                'category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
