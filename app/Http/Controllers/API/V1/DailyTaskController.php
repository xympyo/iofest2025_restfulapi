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
        $tasks = DailyTask::with(['activitiesDone' => function($q) {
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
        $activity = DailyTaskActivity::whereHas('dailyTask', function($q) use ($user) {
            $q->where('id_user', $user->id);
        })->where('id', $activity_id)->firstOrFail();
        if ($activity->is_completed) {
            return response()->json(['message' => 'Activity already completed.'], 400);
        }
        $activity->is_completed = true;
        $activity->completed_at = now();
        $activity->save();
        return response()->json(['message' => 'Activity marked as completed.']);
    }

    // GET /api/v1/daily-tasks/summary
    public function summary(Request $request)
    {
        $user = Auth::user();
        $total = DailyTaskActivity::whereHas('dailyTask', function($q) use ($user) {
            $q->where('id_user', $user->id);
        })->count();
        $completed = DailyTaskActivity::whereHas('dailyTask', function($q) use ($user) {
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
