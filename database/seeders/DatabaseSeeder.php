<?php

namespace Database\Seeders;

use App\Models\ActivityCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Languages
        \App\Models\Language::insert([
            ['languages' => 'Indonesia'],
            ['languages' => 'English'],
        ]);

        // 2. Seed Users
        $users = collect();
        for ($i = 0; $i < 100; $i++) {
            $users->push(\App\Models\User::factory()->create());
        }
        $userIds = $users->pluck('id')->toArray();

        // 3. Pick 30 creators
        $creatorUserIds = collect($userIds)->random(30)->values();
        $nonCreatorUserIds = collect($userIds)->diff($creatorUserIds)->values();

        // 4. Seed Storybooks, Pages, Panels, PanelsContent for each creator
        $languages = \App\Models\Language::pluck('id')->toArray();
        $storybookIds = [];
        foreach ($creatorUserIds as $creatorUserId) {
            $numStorybooks = rand(1, 5);
            for ($s = 0; $s < $numStorybooks; $s++) {
                $storybook = \App\Models\Storybook::create([
                    'title' => fake()->sentence(3),
                    'description' => fake()->sentence(10),
                    'storybook_words' => rand(100, 1000),
                    'read_time' => rand(1, 30),
                    'read_count' => rand(0, 1000),
                    'pages_number' => $pagesNum = rand(1, 6),
                    'is_approved' => rand(0, 1),
                    'id_language' => $languages[array_rand($languages)],
                    'background_image' => 'https://picsum.photos/seed/bg' . uniqid() . '/1920/1080',
                    'storybook_profile' => 'https://picsum.photos/seed/profile' . uniqid() . '/400/400',
                ]);
                $storybookIds[] = $storybook->id;
                // Attach creator
                \App\Models\Creators::create([
                    'id_user' => $creatorUserId,
                    'id_storybook' => $storybook->id,
                ]);
                // Pages
                for ($p = 1; $p <= $pagesNum; $p++) {
                    $page = \App\Models\Pages::create([
                        'storybook_id' => $storybook->id,
                        'page_information' => $p,
                    ]);
                    // Panels (1-3 per page)
                    $numPanels = rand(1, 3);
                    for ($pn = 1; $pn <= $numPanels; $pn++) {
                        $panel = \App\Models\Panels::create([
                            'id_pages' => $page->id,
                            'panels_number' => $pn,
                        ]);
                        // PanelsContent (1 per panel)
                        // Randomize text fields
                        $textFields = collect(['top_text', 'middle_text', 'bottom_text'])->shuffle();
                        $numText = rand(1, 3);
                        $texts = [null, null, null];
                        $aligns = [null, null, null];
                        $alignOptions = ['TextAlign.left', 'TextAlign.center', 'TextAlign.right'];
                        for ($t = 0; $t < $numText; $t++) {
                            $texts[$t] = fake()->sentence(rand(2, 8));
                            $aligns[$t] = $alignOptions[array_rand($alignOptions)];
                        }
                        // Map to correct fields
                        $panelContentData = [
                            'id_panels' => $panel->id,
                            'image' => 'https://picsum.photos/seed/panel' . uniqid() . '/640/1080',
                        ];
                        foreach (['top_text', 'middle_text', 'bottom_text'] as $idx => $field) {
                            $panelContentData[$field] = $texts[$idx];
                            $panelContentData[$field . '_align'] = $texts[$idx] ? $aligns[$idx] : null;
                        }
                        \App\Models\PanelsContent::create($panelContentData);
                    }
                }
            }
        }

        // 5. Ratings and Favorites
        $allStorybookIds = \App\Models\Storybook::pluck('id')->toArray();
        // Ratings: each user rates 3-7 random storybooks
        foreach ($userIds as $userId) {
            $rateCount = rand(3, 7);
            foreach (collect($allStorybookIds)->random($rateCount) as $sbid) {
                \App\Models\Rating::create([
                    'id_user' => $userId,
                    'id_storybook' => $sbid,
                    'rating' => rand(1, 5),
                    'comments' => fake()->sentence(rand(4, 12)),
                ]);
            }
        }
        // Favorites: each user favorites 2-5 random storybooks
        foreach ($userIds as $userId) {
            $favCount = rand(2, 5);
            foreach (collect($allStorybookIds)->random($favCount) as $sbid) {
                \App\Models\Favorites::create([
                    'id_user' => $userId,
                    'id_storybook' => $sbid,
                ]);
            }
        }

        $this->call([
            ActivityCategorySeeder::class,
            ActivitySeeder::class,
            GenreSeeder::class,
        ]);

    }
}
