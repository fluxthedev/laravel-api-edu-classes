<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;

Route::apiResource('resources', ResourceController::class);
