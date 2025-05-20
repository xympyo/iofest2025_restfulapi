<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/create-storybook', function () {
    return view('create_storybook');
})->middleware(['auth'])->name('create_storybook');

Route::get('/page-editor-storybook', function () {
    return view('page_editor_storybook');
})->middleware(['auth'])->name('page_editor_storybook');

Route::get('/panel-editor-storybook', function () {
    return view('panel_editor_storybook');
})->middleware(['auth'])->name('panel_editor_storybook');

Route::post('/api/upload-temp-bg', [App\Http\Controllers\UploadTempBgController::class, 'upload'])->middleware(['auth'])->name('upload_temp_bg');

Route::get('/confirm-storybook', function () {
    return view('confirm_storybook');
})->middleware(['auth'])->name('confirm_storybook');

Route::post('/api/upload-storybook', [App\Http\Controllers\StorybookUploadController::class, 'upload'])->middleware(['auth']);
