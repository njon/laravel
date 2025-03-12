<?php

use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeminiController::class, 'store']);



