<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyTask;
use App\Models\DailyTaskActivity;
use App\Models\Activity;
use Illuminate\Support\Carbon;

class DailyTaskController extends Controller
{
    // GET /api/v1/daily-tasks
    public function index(Request $request)
    {
        $user = Auth::user();
        $tasks = DailyTask::with(['activitiesDone' => function ($q) {
            $q->withPivot(['is_completed', 'completed_at']);
        }, 'dailyTaskActivities'])
            ->where('id_user', $user->id)
            ->orderByDesc('created_at')
            ->get();
        return response()->json($tasks);
    }

    // POST /api/v1/daily-tasks/{activity_id}/complete
    public function complete(Request $request, $activity_id)
    {
        $user = Auth::user();
        // Validate input
        $validated = $request->validate([
            'understanding' => 'required|integer|min:1|max:3',
            'participation' => 'required|integer|min:1|max:3',
            'notes' => 'nullable|string|max:255',
        ]);

        // Find or create today's daily task for the user
        $today = now()->startOfDay();
        $dailyTask = DailyTask::where('id_user', $user->id)
            ->whereDate('created_at', $today)
            ->first();
        if (!$dailyTask) {
            // Create a new daily task for today
            $dailyTask = new DailyTask();
            $dailyTask->id_user = $user->id;
            $dailyTask->created_at = now();
            $dailyTask->save();
        }

        // Find the activity for the user for today's daily task
        $activity = DailyTaskActivity::where('daily_task_id', $dailyTask->id)
            ->where('activity_id', $activity_id)
            ->orderByDesc('created_at')
            ->first();

        // If not found, create a new one (allow multiple completions per day/activity)
        if (!$activity || $activity->is_completed) {
            $activity = new DailyTaskActivity();
            $activity->daily_task_id = $dailyTask->id;
            $activity->activity_id = $activity_id;
        }


        $activity->is_completed = true;
        $activity->completed_at = now();
        $activity->understanding = $validated['understanding'];
        $activity->participation = $validated['participation'];
        $activity->notes = $validated['notes'] ?? null;
        $activity->save();

        // Increment the correct count in DailyTask based on activity's category
        $categoryId = $activity->activity()->first()->activity_category_id ?? null;
        if ($categoryId) {
            switch ($categoryId) {
                case 1:
                    $dailyTask->cognitive_count = ($dailyTask->cognitive_count ?? 0) + 1;
                    break;
                case 2:
                    $dailyTask->sensory_count = ($dailyTask->sensory_count ?? 0) + 1;
                    break;
                case 3:
                    $dailyTask->motor_count = ($dailyTask->motor_count ?? 0) + 1;
                    break;
                case 4:
                    $dailyTask->emotional_count = ($dailyTask->emotional_count ?? 0) + 1;
                    break;
            }
            $dailyTask->save();
        }

        return response()->json([
            'message' => 'Activity marked as completed.',
            'data' => [
                'id' => $activity->id,
                'daily_task_id' => $activity->daily_task_id,
                'activity_id' => $activity->activity_id,
                'understanding' => $activity->understanding,
                'participation' => $activity->participation,
                'notes' => $activity->notes,
                'completed_at' => $activity->completed_at,
            ]
        ]);
    }

    // POST /api/v1/daily-tasks/storybook/complete
    public function completeStorybook(Request $request)
    {
        $user = Auth::user();
        // Find or create today's daily task for the user
        $today = now()->startOfDay();
        $dailyTask = DailyTask::where('id_user', $user->id)
            ->whereDate('created_at', $today)
            ->first();
        if (!$dailyTask) {
            $dailyTask = new DailyTask();
            $dailyTask->id_user = $user->id;
            $dailyTask->created_at = now();
            $dailyTask->save();
        }
        // TODO: Implement logic for storybook completion (increment counts, etc.)
        return response()->json(['message' => 'Storybook completion endpoint (to be implemented).']);
    }

    // GET /api/v1/daily-tasks/summary
    public function summary(Request $request)
    {
        $user = Auth::user();
        $total = DailyTaskActivity::whereHas('dailyTask', function ($q) use ($user) {
            $q->where('id_user', $user->id);
        })->count();
        $completed = DailyTaskActivity::whereHas('dailyTask', function ($q) use ($user) {
            $q->where('id_user', $user->id);
        })->where('is_completed', true)->count();
        $incomplete = $total - $completed;
        return response()->json([
            'total' => $total,
            'completed' => $completed,
            'incomplete' => $incomplete
        ]);
    }
}
