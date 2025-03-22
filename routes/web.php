<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;


// Users Routes
Route::resource('users', UsersController::class);

