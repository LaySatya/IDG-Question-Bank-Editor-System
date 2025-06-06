<?php

use App\Http\Controllers\Auth\ClerkUserController;
use App\Http\Controllers\Auth\MoodleUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Moodle\Questions\MoodleGetQuestionController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware(['moodle.token'])->group(function () {
    // Route::get('questions/user', [MoodleGetQuestionController::class, 'showUserByField']);
    Route::get('questions', [MoodleGetQuestionController::class, 'showAllQuestions']);
    Route::get('questions/pagination', [MoodleGetQuestionController::class, 'showQuestionPaginations']);
});

Route::post('/user', [MoodleUserController::class, 'login']);
