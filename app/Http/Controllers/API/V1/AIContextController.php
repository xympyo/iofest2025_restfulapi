<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StorybookReads;
use App\Models\Storybook;
use App\Models\DailyTask;
use App\Models\DailyTaskActivity;
use App\Models\Rating;
use App\Models\Favorites;
use App\Models\Genre;
use App\Models\Activity;
use App\Models\ActivityCategory;

class AIContextController extends Controller
{
    /**
     * Return all relevant user and learning context for AI chatbot.
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Recent storybooks read (limit 5)
        $recentReads = StorybookReads::where('id_user', $user->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
        $recentStorybooks = $recentReads->map(function($read) {
            $storybook = $read->storybook;
            $rating = Rating::where('id_user', $read->id_user)
                ->where('id_storybook', $read->id_storybook)
                ->first();
            return [
                'id' => $storybook->id,
                'title' => $storybook->title,
                'description' => $storybook->description,
                'date_read' => $read->created_at->toDateString(),
                'rating' => $rating ? $rating->rating : null,
                'comments' => $rating ? $rating->comments : null,
            ];
        });

        // Latest daily task
        $dailyTask = DailyTask::where('id_user', $user->id)
            ->orderByDesc('created_at')
            ->first();
        $dailyTaskData = $dailyTask ? [
            'reading_time' => $dailyTask->reading_time,
            'words_count' => $dailyTask->words_count,
            'cognitive_count' => $dailyTask->cognitive_count,
            'sensory_count' => $dailyTask->sensory_count,
            'motor_count' => $dailyTask->motor_count,
            'emotional_count' => $dailyTask->emotional_count,
        ] : null;

        // Recent activities (limit 5)
        $recentActivities = $dailyTask
            ? DailyTaskActivity::where('daily_task_id', $dailyTask->id)
                ->orderByDesc('completed_at')
                ->limit(5)
                ->get()
                ->map(function($activity) {
                    $act = Activity::find($activity->activity_id);
                    $cat = $act && $act->id_category ? ActivityCategory::find($act->id_category) : null;
                    return [
                        'activity' => $act ? $act->name : null,
                        'category' => $cat ? $cat->name : null,
                        'is_completed' => (bool) $activity->is_completed,
                        'understanding' => $activity->understanding,
                        'participation' => $activity->participation,
                        'notes' => $activity->notes,
                    ];
                })
            : collect();

        // Favorites
        $favoriteBooks = Favorites::where('id_user', $user->id)->get();
        $favorites = $favoriteBooks->map(function($fav) {
            $storybook = Storybook::find($fav->id_storybook);
            return $storybook ? [
                'id' => $storybook->id,
                'title' => $storybook->title,
            ] : null;
        })->filter();

        // Genres (from storybooks read or favorited)
        $genreIds = collect();
        foreach ($recentReads as $read) {
            $storybook = $read->storybook;
            if ($storybook && $storybook->genres) {
                foreach ($storybook->genres as $genre) {
                    $genreIds->push($genre->id);
                }
            }
        }
        foreach ($favoriteBooks as $fav) {
            $storybook = Storybook::find($fav->id_storybook);
            if ($storybook && $storybook->genres) {
                foreach ($storybook->genres as $genre) {
                    $genreIds->push($genre->id);
                }
            }
        }
        $genres = Genre::whereIn('id', $genreIds->unique())->pluck('genre_name')->values();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->username,
            ],
            'recent_storybooks' => $recentStorybooks,
            'daily_task' => $dailyTaskData,
            'recent_activities' => $recentActivities,
            'favorites' => $favorites->values(),
            'genres' => $genres,
        ]);
    }
}
