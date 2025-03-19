<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\ServicesController;

// Users Routes
Route::resource('users', UsersController::class);
Route::post('/users/{id}/upload-avatar', [UsersController::class, 'uploadAvatar'])->name('users.uploadAvatar');
Route::delete('/users/{id}/delete-avatar', [UsersController::class, 'deleteAvatar'])->name('users.deleteAvatar');

// Stores Routes
Route::resource('stores', StoresController::class);

// Route for uploading the main image
Route::post('/stores/upload-image', [StoresController::class, 'uploadImage'])->name('stores.uploadImage');
Route::delete('/stores/delete-image', [StoresController::class, 'deleteImage'])->name('stores.deleteImage');

// Route for uploading gallery images
Route::post('/stores/upload-gallery', [StoresController::class, 'uploadGallery'])->name('stores.uploadGallery');
Route::delete('/stores/delete-gallery', [StoresController::class, 'deleteGallery'])->name('stores.deleteGallery');

// Services Routes
Route::resource('services', ServicesController::class);

