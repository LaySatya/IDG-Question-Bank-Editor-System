<?php

use App\Http\Controllers\Auth\ClerkUserController;
use App\Http\Controllers\Auth\MoodleUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Moodle\MoodleQuestionController;
use App\Services\Auth\MoodleUser\MoodleUserService;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/questions/status', [MoodleQuestionController::class, 'setQuestionStatusById']);


// Show all categories
Route::get('/questions/categories', [MoodleQuestionController::class, 'showCategories']);

// Get courses by fields
Route::get('/questions/courses', [MoodleQuestionController::class, 'showCoursesByFields']);

// Get quizzes by course ID
Route::get('/questions/quizzes', [MoodleQuestionController::class, 'showQuestionsByFields']);

// Get course contents
Route::get('/questions/contents', [MoodleQuestionController::class, 'showCourseContents']);

// Get quiz attempts
Route::get('/questions/quiz-attempts', [MoodleQuestionController::class, 'showQuizAttempts']);

// Get question attempts review
Route::get('/questions/attempt-review', [MoodleQuestionController::class, 'showAttemptReviewQuestions']);

// Get summary of questions
Route::get('/questions/summary', [MoodleQuestionController::class, 'showSummaryQuestions']);



// your protected routes
Route::middleware(['moodle.token'])->group(function () {
    Route::get('questions/user', [MoodleQuestionController::class, 'showUserByField']);
});

Route::post('/user', [MoodleUserController::class, 'login']);
