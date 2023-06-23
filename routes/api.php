<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;
use App\Http\Controller\UserController;

// Endpoints
Route::middleware('auth:sanctum')->group(function () {
  Route::apiResource('resources', ResourceController::class);
  Route::apiResource('users', UserController::class);
});

// Generate auth token for specific user
Route::post('users/{id}/token', [UserController::class, 'generateToken']);
