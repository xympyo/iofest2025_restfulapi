<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DailyTask;
use App\Models\Storybook;

class HomePageController extends Controller
{
    // GET /api/v1/home
    public function index(Request $request)
    {
        $user = Auth::user();

        // User info
        $userInfo = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ];

        // Daily task summary
        $dailyTasks = DailyTask::with(['completedActivities', 'incompleteActivities'])
            ->where('id_user', $user->id)
            ->orderByDesc('created_at')
            ->first();
        $dailyTaskSummary = null;
        if ($dailyTasks) {
            $dailyTaskSummary = [
                'total_activities' => $dailyTasks->activitiesDone->count(),
                'completed' => $dailyTasks->completedActivities->count(),
                'incomplete' => $dailyTasks->incompleteActivities->count(),
            ];
        }

        // Storybook of the Day: highest read_count, then highest avg rating
        $storybookOfTheDay = Storybook::with('ratings')
            ->where('is_approved', 1)
            ->orderByDesc('read_count')
            ->get()
            ->sortByDesc(function ($storybook) {
                $ratings = $storybook->ratings->pluck('rating');
                return $ratings->count() ? $ratings->avg() : 0;
            })
            ->first();

        // Newest Storybook: approved, latest
        $newestStorybook = Storybook::where('is_approved', 1)
            ->orderByDesc('created_at')
            ->first();

        // Most Viewed Storybook: most entries in storybook_reads
        $mostViewedStorybook = Storybook::withCount('storybook_reads')
            ->orderByDesc('storybook_reads_count')
            ->where('is_approved', 1)
            ->first();

        // Recommended Storybooks: not read by current user, by read_count
        $readStorybookIds = $user->storybook_reads->pluck('id_storybook')->unique();
        $recommendedStorybooks = Storybook::whereNotIn('id', $readStorybookIds)
            ->where('is_approved', 1)
            ->orderByDesc('read_count')
            ->limit(5)
            ->get();

        // Recent storybooks (limit 5)
        $recentStorybooks = Storybook::where('is_approved', 1)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get(['id', 'title', 'description', 'storybook_profile']);

        // Filter by genre if genre_id provided
        $filteredStorybooks = null;
        if ($request->has('genre_id')) {
            $genreId = $request->input('genre_id');
            $filteredStorybooks = Storybook::whereHas('genres', function ($q) use ($genreId) {
                $q->where('genre_id', $genreId);
            })
                ->where('is_approved', 1)
                ->get();
        }

        return response()->json([
            'user' => $userInfo,
            'daily_task_summary' => $dailyTaskSummary,
            'storybook_of_the_day' => $storybookOfTheDay ? new \App\Http\Resources\V1\StorybookResource($storybookOfTheDay) : null,
            'newest_storybook' => $newestStorybook ? new \App\Http\Resources\V1\StorybookResource($newestStorybook) : null,
            'most_viewed_storybook' => $mostViewedStorybook ? new \App\Http\Resources\V1\StorybookResource($mostViewedStorybook) : null,
            'recommended_storybooks' => \App\Http\Resources\V1\StorybookResource::collection($recommendedStorybooks),
            'recent_storybooks' => \App\Http\Resources\V1\StorybookResource::collection($recentStorybooks),
            'filtered_storybooks' => $filteredStorybooks !== null ? \App\Http\Resources\V1\StorybookResource::collection($filteredStorybooks) : null,
        ]);
    }

    // GET /api/v1/daily-tasks/today/full
    public function todayFull(Request $request)
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        $dailyTasks = \App\Models\DailyTask::with([
            'storybook_read',
            'dailyTaskActivities.activity.activity_category',
        ])
        ->where('id_user', $user->id)
        ->whereDate('created_at', $today)
        ->get();

        // Format the response to include activity details
        $result = $dailyTasks->map(function($task) {
            return [
                'id' => $task->id,
                'id_user' => $task->id_user,
                'id_storybook_reads' => $task->id_storybook_reads,
                'reading_time' => $task->reading_time,
                'words_count' => $task->words_count,
                'cognitive_count' => $task->cognitive_count,
                'sensory_count' => $task->sensory_count,
                'motor_count' => $task->motor_count,
                'emotional_count' => $task->emotional_count,
                'created_at' => $task->created_at,
                'updated_at' => $task->updated_at,
                'storybook_read' => $task->storybook_read,
                'daily_task_activities' => collect($task->dailyTaskActivities)->map(function($activity) {
                    $act = $activity->activity;
                    $cat = $act && $act->activity_category ? $act->activity_category : null;
                    return [
                        'id' => $activity->id,
                        'daily_task_id' => $activity->daily_task_id,
                        'activity_id' => $activity->activity_id,
                        'is_completed' => $activity->is_completed,
                        'completed_at' => $activity->completed_at,
                        'understanding' => $activity->understanding,
                        'participation' => $activity->participation,
                        'notes' => $activity->notes,
                        'created_at' => $activity->created_at,
                        'updated_at' => $activity->updated_at,
                        'activity' => $act ? [
                            'title' => $act->title,
                            'description' => $act->description,
                            'activity_category_id' => $act->activity_category_id,
                            'activity_category_name' => $cat ? $cat->name : null,
                        ] : null,
                    ];
                }),
            ];
        });

        return response()->json([
            'daily_tasks' => $result
        ]);
    }
}
