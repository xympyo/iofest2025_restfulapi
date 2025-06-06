<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Storybook;

class StorybookAnalyticsController extends Controller
{
    public function performance(Request $request)
    {
        $user = $request->user();
        $storybooks = Storybook::where('id_creator', $user->id)->withCount(['storybook_reads', 'get_favorite_report', 'get_rating_report'])->get();
        $data = $storybooks->map(function ($sb) {
            return [
                'id' => $sb->id,
                'title' => $sb->title,
                'read_count' => $sb->storybook_reads_count,
                'favorite_count' => $sb->get_favorite_report_count,
                'average_rating' => $sb->get_rating_report->avg('pivot.rating'),
            ];
        });
        return response()->json($data);
    }
}
