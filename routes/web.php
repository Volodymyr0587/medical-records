<?php

declare(strict_types=1);

use App\Http\Controllers\RecordController;
use App\Http\Controllers\RecordMediaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('records', RecordController::class);
    Route::delete('records/{record}/media/{media}', [RecordMediaController::class, 'destroy'])
        ->name('records.media.destroy');
});

require __DIR__ . '/settings.php';
