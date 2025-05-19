<?php

namespace App\Http\Controllers;

use App\Models\Panels;
use App\Http\Requests\StorePanelsRequest;
use App\Http\Requests\UpdatePanelsRequest;

class PanelsController extends Controller
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
    public function store(StorePanelsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Panels $panels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panels $panels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePanelsRequest $request, Panels $panels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panels $panels)
    {
        //
    }
}
