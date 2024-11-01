<?php

use App\Http\Controllers\AudioFileController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonsController;

Route::prefix('/seasons')->group(function () {
    Route::post('/', [SeasonsController::class, 'create'])->name('seasons.create');
});

Route::prefix('/episodes')->group(function () {
    Route::post('/', [EpisodesController::class, 'create'])->name('episodes.create');
});

Route::prefix('/audio')->group(function () {
    Route::get('upload-url', [AudioFileController::class, 'presignedUrl'])->name('audio.upload-url');
});

Route::prefix('/image')->group(function () {
    Route::get('upload-url', [\App\Http\Controllers\ImageFileController::class, 'presignedUrl'])->name('image.upload-url');
});
