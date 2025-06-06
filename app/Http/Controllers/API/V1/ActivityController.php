<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityCategory;

class ActivityController extends Controller
{
    // List all activities with their categories
    public function index()
    {
        $activities = Activity::with('activity_category')->get();
        return response()->json($activities);
    }

    // Get random activities for daily tasks
    public function random(Request $request)
    {
        $count = $request->input('count', 5);
        $activities = Activity::inRandomOrder()->limit($count)->with('activity_category')->get();
        return response()->json($activities);
    }
}
