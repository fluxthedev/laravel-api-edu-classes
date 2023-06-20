<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;

Route::get('/resources', [ResourceController::class, 'index']);
Route::get('/resources/{id}', [ResourceController::class, 'show']);
