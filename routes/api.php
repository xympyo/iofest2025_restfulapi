<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// api/v1/storybook
Route::prefix('v1')->group(function () {
    Route::apiResource('storybook', \App\Http\Controllers\API\V1\StorybookController::class);
    Route::apiResource('creator', \App\Http\Controllers\API\V1\CreatorsController::class);
});
