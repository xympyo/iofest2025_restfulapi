<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Creators;
use App\Http\Requests\StoreCreatorsRequest;
use App\Http\Requests\UpdateCreatorsRequest;

class CreatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creators = \App\Models\Creators::all();
        return \App\Http\Resources\V1\CreatorResource::collection($creators);
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
    public function store(StoreCreatorsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Creators $creators)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Creators $creators)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreatorsRequest $request, Creators $creators)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creators $creators)
    {
        //
    }
}
