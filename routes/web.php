<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('custom/dashboard');
    })->name('dashboard');

    Route::controller(\App\Http\Controllers\Statics\PageController::class)->group(function (){
        Route::get('dashboard-07', 'dashboard07')->name('dashboard07');
        Route::get('sidebar-01', 'sidebar01')->name('sidebar01');
        Route::get('sidebar-11', 'sidebar11')->name('sidebar11');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
