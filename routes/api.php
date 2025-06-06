<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// api/v1/storybook
Route::prefix('v1')->group(function () {
    // Authentication
    Route::post('register', [\App\Http\Controllers\API\V1\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\API\V1\AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [\App\Http\Controllers\API\V1\AuthController::class, 'logout']);

    // User's storybook performance analytics
    Route::middleware('auth:sanctum')->get('my-storybooks/performance', [\App\Http\Controllers\API\V1\StorybookAnalyticsController::class, 'performance']);

    Route::apiResource('storybook', \App\Http\Controllers\API\V1\StorybookController::class);
    Route::apiResource('creator', \App\Http\Controllers\API\V1\CreatorsController::class);
});
