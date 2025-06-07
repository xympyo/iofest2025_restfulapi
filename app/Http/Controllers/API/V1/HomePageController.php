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
}
