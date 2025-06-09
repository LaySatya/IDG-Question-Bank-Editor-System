<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MoodleUserController;
use App\Http\Controllers\Moodle\Categories\MoodleGetQuestionCategoryController;
use App\Http\Controllers\Moodle\Questions\MoodleGetQuestionController;
use App\Http\Controllers\Moodle\Questions\MoodleUpdateQuestionController;

// Public route for login
Route::post('/users', [MoodleUserController::class, 'login']);

// Protected routes
Route::middleware(['moodle.token'])->group(function () {

    // Question routes
    Route::prefix('questions')->controller(MoodleGetQuestionController::class)->group(function () {
        Route::get('/', 'showAllQuestions'); // /questions
        Route::get('/pagination', 'showAllQuestionPaginations'); // /questions/pagination
        Route::get('/pagination/category', 'showPaginationQuestionsByCategory'); // /questions/pagination/category
        Route::get('/question', 'showQuestionById'); // /questions/question
    });

    // Bulk update questions
    Route::prefix('questions')->controller(MoodleUpdateQuestionController::class)->group(function(){
        Route::post('/status','bulkUpdateQuestionStatus'); // /questions/status
    });

    // Question category routes
    Route::prefix('questions/categories')->controller(MoodleGetQuestionCategoryController::class)->group(function () {
        Route::get('/', 'showAllQuestionCategories'); // /questions/categories
    });

    // User routes
    Route::prefix('users')->controller(MoodleUserController::class)->group(function () {
        Route::get('/', 'showUsersByRole'); // /users
        Route::get('/user-by-username', 'showUserByUsername'); // /users/user-by-username
    });

});
