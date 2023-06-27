<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CSVExportController;

// Generate auth token for specific user
Route::post('users/{id}/token', [UserController::class, 'generateToken'])->name('generate_token');


// Endpoints
Route::middleware('auth:sanctum')->group(function () {
  Route::apiResource('resources', ResourceController::class);
  Route::apiResource('users', UserController::class);
  Route::get('/export-resources', [CSVExportController::class, 'exportResources']);
});
