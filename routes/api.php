<?php

use App\Http\Controllers\Auth\ClerkUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\JwtLoginController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/users', [ClerkUserController::class,'register']);
Route::get('/users', [ClerkUserController::class, 'getAllUsers']);
Route::get('/users/{id}', [ClerkUserController::class,'getUserById']);
Route::middleware(['clerk.auth'])->group(function () {

});
