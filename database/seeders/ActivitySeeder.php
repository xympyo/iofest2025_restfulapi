<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Assume category IDs are 1: Cognitive, 2: Sensory, 3: Motory, 4: Emotional
        $activities = [
            // Cognitive
            ['activity_category_id' => 1, 'activity_name' => 'Memory Match', 'activity_description' => 'Find matching pairs of cards.'],
            ['activity_category_id' => 1, 'activity_name' => 'Puzzle Solving', 'activity_description' => 'Complete a simple puzzle.'],
            ['activity_category_id' => 1, 'activity_name' => 'Word Search', 'activity_description' => 'Find hidden words in a grid.'],
            // Sensory
            ['activity_category_id' => 2, 'activity_name' => 'Texture Hunt', 'activity_description' => 'Find objects with different textures.'],
            ['activity_category_id' => 2, 'activity_name' => 'Sound Guessing', 'activity_description' => 'Guess the sound from a recording.'],
            ['activity_category_id' => 2, 'activity_name' => 'Color Sorting', 'activity_description' => 'Sort objects by color.'],
            // Motory
            ['activity_category_id' => 3, 'activity_name' => 'Jumping Jacks', 'activity_description' => 'Do 10 jumping jacks.'],
            ['activity_category_id' => 3, 'activity_name' => 'Balance Walk', 'activity_description' => 'Walk in a straight line without falling.'],
            ['activity_category_id' => 3, 'activity_name' => 'Ball Toss', 'activity_description' => 'Toss a ball into a basket.'],
            // Emotional
            ['activity_category_id' => 4, 'activity_name' => 'Feelings Charades', 'activity_description' => 'Act out different emotions.'],
            ['activity_category_id' => 4, 'activity_name' => 'Gratitude Journal', 'activity_description' => 'Write down something you are grateful for.'],
            ['activity_category_id' => 4, 'activity_name' => 'Compliment Circle', 'activity_description' => 'Give a compliment to someone.'],
        ];

        foreach ($activities as $activity) {
            DB::table('activities')->insert([
                'activity_category_id' => $activity['activity_category_id'],
                'activity_name' => $activity['activity_name'],
                'activity_description' => $activity['activity_description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
