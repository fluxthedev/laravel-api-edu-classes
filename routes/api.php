<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserController; // Fixed typo here

// Generate auth token for specific user
Route::post('users/{id}/token', [UserController::class, 'generateToken'])->name('generate_token');


// Endpoints
Route::middleware('auth:sanctum')->group(function () {
  Route::apiResource('resources', ResourceController::class);
  Route::apiResource('users', UserController::class);
});
