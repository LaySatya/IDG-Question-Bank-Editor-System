<?php

use App\Http\Controllers\Auth\ClerkUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Moodle\MoodleQuestionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/users', [ClerkUserController::class,'register']);
Route::middleware(['clerk.auth'])->group(function () {
    // get all users
    Route::get('/users', [ClerkUserController::class, 'getAllUsers']);

    // get specific user by id
    Route::get('/users/{id}', [ClerkUserController::class,'getUserById']);

    // Questions Routes
    Route::post('/questions/status', [MoodleQuestionController::class, 'setQuestionStatusById']);
});
