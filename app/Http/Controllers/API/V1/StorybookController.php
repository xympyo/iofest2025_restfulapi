<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Storybook;
use App\Http\Requests\StoreStorybookRequest;
use App\Http\Requests\UpdateStorybookRequest;
use App\Http\Resources\V1\StorybookResource;
use App\Http\Resources\V1\StorybookCollection;

class StorybookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new StorybookCollection(Storybook::paginate());
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
    public function store(StoreStorybookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Storybook $storybook)
    {
        $storybook->load(['genres', 'pages.panels.panelContents']);
        return new StorybookResource($storybook);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Storybook $storybook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStorybookRequest $request, Storybook $storybook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Storybook $storybook)
    {
        //
    }
}
