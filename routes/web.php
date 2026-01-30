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

    Route::controller(\App\Http\Controllers\Sessions\RoomSessionController::class)->group(function (){
        Route::get('room-session', 'showRoomSessionPaginate')->name('room.session.page');
    });

    Route::controller(\App\Http\Controllers\Rooms\RoomController::class)->group(function (){
        Route::get('room', 'showRoomPaginate')->name('room.page');
    });

    Route::controller(\App\Http\Controllers\Users\UserController::class)->group(function (){
        Route::get('users', 'showUserPagination')->name('user.page');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
