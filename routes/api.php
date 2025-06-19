<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MoodleUserController;
use App\Http\Controllers\Moodle\Categories\MoodleGetCourseCategoryController;
use App\Http\Controllers\Moodle\Categories\MoodleGetQuestionCategoryController;
use App\Http\Controllers\Moodle\Questions\MoodleGetQuestionController;
use App\Http\Controllers\Moodle\Questions\MoodleUpdateQuestionController;
use App\Http\Controllers\Moodle\Tags\MoodleActionsQuestionTagsController;
use App\Http\Controllers\Moodle\Tags\MoodleGetTagController;

// Public route for login
Route::post('/users', [MoodleUserController::class, 'login']);

// Protected routes
// Route::middleware(['moodle.token'])->group(function () {

    // User routes
    Route::prefix('users')->controller(MoodleUserController::class)->group(function () {
        Route::get('/','showAllUsers');
        Route::get('/user-role', 'showUsersByRole'); // /users
        Route::get('/user-by-username', 'showUserByUsername'); // /users/user-by-username
    });

    // GET Question routes
    Route::prefix('questions')->controller(MoodleGetQuestionController::class)->group(function () {
        Route::get('/', 'showAllQuestions'); // /questions - without pagination
        Route::get('/category', 'showAllQuestionsByCategory'); // /questions/category
        Route::get('/pagination', 'showAllQuestionPaginations'); // /questions/pagination
        Route::get('/pagination/category', 'showPaginationQuestionsByCategory'); // /questions/pagination/category
        Route::get('/question', 'showQuestionById'); // /questions/question
        Route::get('/tags-with-category','showAllQuestionsByTagWithSpecificCategory'); // /questions/tags
        Route::get('/qtypes','showAllQuestionTypes');
        Route::get('/questions-by-qtype','showQuestionsByQtype');
        Route::get('/filters','fullFilterQuestions');
    });

    // Bulk update questions
    Route::prefix('questions')->controller(MoodleUpdateQuestionController::class)->group(function(){
        Route::put('/','updateQuestionName');
        Route::post('/status','bulkUpdateQuestionStatus'); // /questions/status
        Route::post('/set-question-status', 'setQuestionStatusByQuestionId'); // /questions/set-status
        Route::post('/bulk-tags','bulkEditAddQuestionsTags');
        Route::delete('/bulk-tags','bulkEditRemoveTagsFromQuestions'); // /questions/bulk-tags
    });

    // Question category routes
    Route::prefix('questions')->controller(MoodleGetQuestionCategoryController::class)->group(function () {
        Route::get('/categories', 'showAllQuestionCategories'); // /questions/categories
    });

     // Course category routes
    Route::prefix('questions')->controller(MoodleGetCourseCategoryController::class)->group(function () {
        Route::get('/course-categories', 'showAllCourseCategories'); // /questions/categories
        Route::get('/courses','showCoursesByCategory');
    });


    // Tags routes
    Route::prefix('questions')->controller(MoodleGetTagController::class)->group(function () {
        Route::get('/tags', 'showAllTags'); // /tags
        Route::get('/tag', 'showTagById'); // /tags/tag
        Route::get('/question-tags', 'showTagsByQuestionId'); // /tags/question
    });
    // Add tags to a question
    Route::prefix('questions')->controller(MoodleActionsQuestionTagsController::class)->group(function () {
        Route::post('tags', 'addTagsToAQuestion'); // /tags/add
        Route::delete('tags', 'removeTagsFromAQuestion'); // /tags/remove
    });



// });
