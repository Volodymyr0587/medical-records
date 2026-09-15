<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RecordMediaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('records', RecordController::class);

    Route::get('records/{record}/media/{media}', [RecordMediaController::class, 'show'])
        ->name('records.media.show');

    Route::get('records/{record}/media/{media}/download', [RecordMediaController::class, 'download'])
        ->name('records.media.download');

    Route::delete('records/{record}/media/{media}', [RecordMediaController::class, 'destroy'])
        ->name('records.media.destroy');
});

require __DIR__.'/settings.php';
