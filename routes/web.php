<?php

declare(strict_types=1);

use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('records', RecordController::class);
});

require __DIR__ . '/settings.php';
