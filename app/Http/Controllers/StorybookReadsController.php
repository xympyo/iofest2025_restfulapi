<?php

namespace App\Http\Controllers;

use App\Models\StorybookReads;
use App\Http\Requests\StoreStorybookReadsRequest;
use App\Http\Requests\UpdateStorybookReadsRequest;

class StorybookReadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStorybookReadsRequest $request)
    {
        try {
            $user = auth()->user();

            $validated = $request->validate([
                'id_storybook' => 'required|integer|exists:storybooks,id',
            ]);
            $id_storybook = $validated['id_storybook'];

            // Find today's DailyTask for this user (created_at is today)
            $today = now()->toDateString();
            $dailyTask = \App\Models\DailyTask::where('id_user', $user->id)
                ->whereDate('created_at', $today)
                ->first();
            if (!$dailyTask) {
                // Create a new daily task for today if not exists
                $dailyTask = new \App\Models\DailyTask();
                $dailyTask->id_user = $user->id;
                $dailyTask->created_at = now();
                $dailyTask->words_count = 0;
                $dailyTask->reading_time = 0;
                $dailyTask->save();
            }

            // Get storybook info
            $storybook = \App\Models\Storybook::findOrFail($id_storybook);
            $storybook_words = $storybook->storybook_words ?? 0;
            $read_time = $storybook->read_time ?? 0;

            // Check if this is the user's first read of this storybook
            $alreadyRead = \App\Models\StorybookReads::where('id_user', $user->id)
                ->where('id_storybook', $id_storybook)
                ->exists();

            // Create StorybookReads
            $storybookReads = new \App\Models\StorybookReads();
            $storybookReads->id_user = $user->id;
            $storybookReads->id_storybook = $id_storybook;
            $storybookReads->id_daily_task = $dailyTask->id;
            $storybookReads->save();

            // Increment read_count only if first read
            if (!$alreadyRead) {
                $storybook->increment('read_count');
            }

            // Update DailyTask
            $dailyTask->words_count = ($dailyTask->words_count ?? 0) + $storybook_words;
            $dailyTask->reading_time = ($dailyTask->reading_time ?? 0) + $read_time;
            $dailyTask->save();

            // Create or update Rating (no duplicates for user+storybook)
            $ratingValue = $request->input('rating', 1);
            $comments = $request->input('comments');
            if ($comments === '' || $comments === null) {
                $comments = null;
            }
            $rating = \App\Models\Rating::updateOrCreate(
                [
                    'id_user' => $user->id,
                    'id_storybook' => $id_storybook,
                ],
                [
                    'rating' => $ratingValue,
                    'comments' => $comments,
                ]
            );

            return response()->json([
                'message' => 'Storybook read recorded, daily task updated, and rating added.',
                'data' => [
                    'storybook_reads' => $storybookReads,
                    'daily_task' => $dailyTask,
                    'rating' => $rating,
                ]
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StorybookReads $storybookReads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StorybookReads $storybookReads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStorybookReadsRequest $request, StorybookReads $storybookReads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StorybookReads $storybookReads)
    {
        //
    }
}
