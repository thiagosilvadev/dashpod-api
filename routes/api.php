<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PodcastsController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\MembershipMiddleware;
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

Route::get('/invites/{invite}', [MembershipController::class, 'createInvite'])->name('membership.create-invite')->middleware('signed');

Route::prefix('podcasts')->group(function () {
    Route::post('/', [PodcastsController::class, 'create'])->name('podcasts.create');
})->middleware('auth:sanctum');

Route::prefix('/{membership}')->middleware(['auth:sanctum', MembershipMiddleware::class])->group(function () {
    Route::prefix('/seasons')->group(function () {
        Route::post('/', [SeasonsController::class, 'create'])->name('seasons.create');
    });

    Route::prefix('/episodes')->group(function () {
        Route::post('/', [EpisodesController::class, 'create'])->name('episodes.create');
    });

});
