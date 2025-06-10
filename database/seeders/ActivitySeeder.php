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
            // --- Cognitive Activities (ID: 1) ---
            ['activity_category_id' => 1, 'title' => 'Memory Match', 'description' => 'Find matching pairs of cards.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'Simple Puzzle', 'description' => 'Complete a small, age-appropriate jigsaw puzzle.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'What Comes Next?', 'description' => 'Create a simple pattern (e.g., clap, stomp, clap, stomp) and ask your child to finish it.', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Counting Race', 'description' => 'Count as high as you can together in a minute. Then try to beat your record!', 'duration_minutes' => 2],
            ['activity_category_id' => 1, 'title' => 'Find the Color', 'description' => 'Call out a color and have your child find five objects of that color in the room.', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Story Starter', 'description' => 'Start a story with one sentence and let your child add the next, taking turns.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'Shape Hunt', 'description' => 'Look around the room and find objects that match a specific shape (circle, square, triangle).', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Animal Sounds Match', 'description' => 'Make an animal sound and have your child guess the animal.', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Rhyming Game', 'description' => 'Say a simple word and take turns thinking of words that rhyme with it.', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Which One is Different?', 'description' => 'Lay out 3-4 objects, with one clearly different. Ask your child to identify the different one.', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Sorting Fun', 'description' => 'Sort a small pile of mixed items (e.g., blocks, toys) by color, size, or type.', 'duration_minutes' => 5],
            ['activity_category_id' => 1, 'title' => 'What\'s Missing?', 'description' => 'Place a few objects on a table, have your child close their eyes, remove one, and ask what\'s missing.', 'duration_minutes' => 4],
            ['activity_category_id' => 1, 'title' => 'Opposites Game', 'description' => 'Say a word (e.g., "hot") and have your child say its opposite ("cold").', 'duration_minutes' => 3],
            ['activity_category_id' => 1, 'title' => 'Simple Directions', 'description' => 'Give your child two-step directions (e.g., "Touch your nose, then clap your hands").', 'duration_minutes' => 2],
            ['activity_category_id' => 1, 'title' => 'Number Recognition', 'description' => 'Point to numbers (on a book, clock, etc.) and ask your child to identify them.', 'duration_minutes' => 3],


            // --- Sensory Activities (ID: 2) ---
            ['activity_category_id' => 2, 'title' => 'Texture Hunt', 'description' => 'Find objects with different textures around the house and describe how they feel.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Sound Guessing', 'description' => 'Close your eyes and identify common household sounds (e.g., running water, opening a bag).', 'duration_minutes' => 3],
            ['activity_category_id' => 2, 'title' => 'Color Sorting', 'description' => 'Sort toys or clothes by color, naming each color as you go.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Mystery Bag Touch', 'description' => 'Put a common object in a bag and have your child guess what it is by touch.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Listen to the World', 'description' => 'Sit quietly for a minute and point out all the sounds you can hear both inside and outside.', 'duration_minutes' => 2],
            ['activity_category_id' => 2, 'title' => 'Scent Guessing Game', 'description' => 'Blindfold your child (or close eyes) and let them smell safe items (e.g., fruit, spices) and guess.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Ice Play', 'description' => 'Let your child explore a bowl of ice cubes with their hands, describing how it feels.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Color Mixing', 'description' => 'Use a few drops of food coloring in water to explore how colors mix.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Water Play', 'description' => 'Provide a small bowl of water with cups, sponges, or small toys for free exploration.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Sensory Bin Explore', 'description' => 'If you have a sensory bin (rice, beans, pasta), let your child explore it with small scoops or toys.', 'duration_minutes' => 5],
            ['activity_category_id' => 2, 'title' => 'Feel the Fabric', 'description' => 'Explore different fabrics (e.g., silk, cotton, wool) and talk about how they feel.', 'duration_minutes' => 3],
            ['activity_category_id' => 2, 'title' => 'Light and Shadow Play', 'description' => 'Use a flashlight to make shadows on the wall and create shapes or animals.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Cloud Gazing', 'description' => 'Lie down outside or look out a window and describe shapes you see in the clouds.', 'duration_minutes' => 3],
            ['activity_category_id' => 2, 'title' => 'Sound Shakers', 'description' => 'Put different items (rice, beads, coins) in small containers and listen to the different sounds.', 'duration_minutes' => 4],
            ['activity_category_id' => 2, 'title' => 'Wind Chime Fun', 'description' => 'Make a simple wind chime using common household items and hang it to listen to the sounds.', 'duration_minutes' => 5],


            // --- Motory Activities (ID: 3) ---
            ['activity_category_id' => 3, 'title' => 'Jumping Jacks', 'description' => 'Do 10 jumping jacks together.', 'duration_minutes' => 2],
            ['activity_category_id' => 3, 'title' => 'Balance Walk', 'description' => 'Walk in a straight line (or on a drawn line) without falling, like a tightrope walker.', 'duration_minutes' => 3],
            ['activity_category_id' => 3, 'title' => 'Ball Toss', 'description' => 'Toss a soft ball back and forth, or into a basket.', 'duration_minutes' => 4],
            ['activity_category_id' => 3, 'title' => 'Animal Walks', 'description' => 'Crawl like a bear, waddle like a duck, hop like a bunny across the room.', 'duration_minutes' => 3],
            ['activity_category_id' => 3, 'title' => 'Pillow Obstacle Course', 'description' => 'Arrange pillows to create a simple course to crawl over, under, and around.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Balloon Keepy-Uppy', 'description' => 'Try to keep a balloon off the ground using only hands, feet, or head.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Target Practice', 'description' => 'Crumple up paper and try to toss it into a small bucket or box from a short distance.', 'duration_minutes' => 4],
            ['activity_category_id' => 3, 'title' => 'Dance Party!', 'description' => 'Put on a favorite song and dance freely together.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Follow the Leader', 'description' => 'Take turns leading simple movements like marching, tiptoeing, or stretching.', 'duration_minutes' => 3],
            ['activity_category_id' => 3, 'title' => 'Simon Says', 'description' => 'Play a quick game of Simon Says with actions like "Simon says touch your toes."', 'duration_minutes' => 4],
            ['activity_category_id' => 3, 'title' => 'Crawl Race', 'description' => 'Race each other across the room by crawling on hands and knees.', 'duration_minutes' => 2],
            ['activity_category_id' => 3, 'title' => 'Building Blocks/Tower', 'description' => 'Build the tallest tower you can with blocks or pillows before it tumbles!', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Yoga Poses', 'description' => 'Try a few simple animal-themed yoga poses (e.g., cat-cow, downward dog).', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Finger Painting (Mess-Free)', 'description' => 'Put paint in a Ziploc bag and let your child "finger paint" by squishing the bag.', 'duration_minutes' => 5],
            ['activity_category_id' => 3, 'title' => 'Paper Tearing', 'description' => 'Give your child old newspapers or junk mail to tear into strips or small pieces (great for fine motor).', 'duration_minutes' => 4],


            // --- Emotional Activities (ID: 4) ---
            ['activity_category_id' => 4, 'title' => 'Feelings Charades', 'description' => 'Act out different emotions (happy, sad, angry) and have your child guess.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'What Makes Me Feel...', 'description' => 'Talk about what makes you feel happy, sad, or excited and ask your child the same.', 'duration_minutes' => 5],
            ['activity_category_id' => 4, 'title' => 'Gratitude Moment', 'description' => 'Share one thing you are grateful for today, then ask your child.', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Compliment Circle', 'description' => 'Give a compliment to your child, and encourage them to give one back.', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Calm Down Corner', 'description' => 'Practice a simple deep breathing exercise or find a quiet spot to relax for a minute.', 'duration_minutes' => 2],
            ['activity_category_id' => 4, 'title' => 'Saying "I Love You"', 'description' => 'Take turns telling each other one thing you love about the other person.', 'duration_minutes' => 2],
            ['activity_category_id' => 4, 'title' => 'Empathy Puppet Show', 'description' => 'Use finger puppets or toys to act out a short scenario where one character is sad, and the other helps.', 'duration_minutes' => 5],
            ['activity_category_id' => 4, 'title' => 'Positive Affirmations', 'description' => 'Look in a mirror and say positive things about yourselves (e.g., "I am kind," "I am strong").', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Sharing Rules', 'description' => 'Discuss why sharing is important and practice taking turns with a toy.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'My Favorite Things', 'description' => 'Talk about your favorite things (food, toy, color) and ask your child about theirs.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'Helping Hands', 'description' => 'Find one small way to help someone in the family or around the house (e.g., put away a toy).', 'duration_minutes' => 3],
            ['activity_category_id' => 4, 'title' => 'Thank You Note (Verbal)', 'description' => 'Practice verbally thanking someone (real or imagined) for something.', 'duration_minutes' => 2],
            ['activity_category_id' => 4, 'title' => 'Feeling Faces Drawing', 'description' => 'Draw simple faces showing different emotions and talk about what each emotion feels like.', 'duration_minutes' => 5],
            ['activity_category_id' => 4, 'title' => 'Apology Practice', 'description' => 'Role-play how to apologize when you make a mistake, using polite words.', 'duration_minutes' => 4],
            ['activity_category_id' => 4, 'title' => 'Comfort Kit Brainstorm', 'description' => 'Talk about things that help you feel better when you are sad or mad (e.g., a hug, a blanket).', 'duration_minutes' => 5],
        ];

        foreach ($activities as $activity) {
            DB::table('activity')->insert([
                'activity_category_id' => $activity['activity_category_id'],
                'title' => $activity['title'],
                'description' => $activity['description'],
                'duration_minutes' => $activity['duration_minutes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
