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
            // Add more fields as needed
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

        // Recent storybooks (limit 5)
        $recentStorybooks = Storybook::orderByDesc('created_at')->limit(5)->get(['id', 'title', 'description', 'storybook_profile']);

        // Build response
        return response()->json([
            'user' => $userInfo,
            'daily_task_summary' => $dailyTaskSummary,
            'recent_storybooks' => $recentStorybooks,
        ]);
    }
}
