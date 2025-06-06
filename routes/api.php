<?php

use App\Http\Controllers\Auth\MoodleUserController;
use App\Http\Controllers\Moodle\Categories\MoodleGetQuestionCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Moodle\Questions\MoodleGetQuestionController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware(['moodle.token'])->group(function () {

    // Get all questions
    Route::get('questions', [MoodleGetQuestionController::class, 'showAllQuestions']);

    // Get paginated questions
    Route::get('questions/pagination', [MoodleGetQuestionController::class, 'showAllQuestionPaginations']);

    // Get paginated questions with category
    Route::get('questions/pagination/category', [MoodleGetQuestionController::class, 'showPaginationQuestionsByCategory']);

    // Get all question categories
    Route::get('questions/categories', [MoodleGetQuestionCategoryController::class, 'showAllQuestionCategories']);


    // Get all users by role
    Route::get('/user', [MoodleUserController::class, 'showUsersByRole']);

    // Get user by username
    Route::get('/user-by-username', [MoodleUserController::class, 'showUserByUsername']);

});

Route::post('/user', [MoodleUserController::class, 'login']);
