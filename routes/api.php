<?php

use App\Http\Controllers\PodcastsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('users')->group(function () {
    Route::post('/register', [UsersController::class, 'register'])->name('users.register');
    Route::get('/me', [UsersController::class, 'me'])->name('users.me');
});

Route::prefix('podcasts')->group(function () {
    Route::post('/', [PodcastsController::class, 'create'])->name('podcasts.create');
});
