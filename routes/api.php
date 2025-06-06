<?php

use App\Http\Controllers\Auth\ClerkUserController;
use App\Http\Controllers\Auth\MoodleUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Moodle\MoodleQuestionController;
use Illuminate\Session\Middleware\StartSession;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Set question status by ID
Route::post('/questions/status', [MoodleQuestionController::class, 'setQuestionStatusById']);

// Show all categories
Route::get('/questions/categories', [MoodleQuestionController::class, 'showCategories']);

// Get courses by fields
Route::get('/questions/courses', [MoodleQuestionController::class, 'showCoursesByFields']);





Route::middleware([StartSession::class, 'moodle.token'])->group(function () {
    // Protected routes here
    Route::get('questions/user', [MoodleQuestionController::class, 'showUserByField']);
});

Route::post('/user', [MoodleUserController::class, 'login']);
