<?php

use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
