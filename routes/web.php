<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\ServicesController;

// Users Routes
Route::resource('users', UsersController::class);

// Stores Routes
Route::resource('stores', StoresController::class);

// Services Routes
Route::resource('services', ServicesController::class);