<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use App\Http\Requests\StoreDailyTaskRequest;
use App\Http\Requests\UpdateDailyTaskRequest;

class DailyTaskController extends Controller
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
    public function store(StoreDailyTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyTask $dailyTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyTask $dailyTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyTaskRequest $request, DailyTask $dailyTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyTask $dailyTask)
    {
        //
    }
}
