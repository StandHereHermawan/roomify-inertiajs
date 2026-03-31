<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('custom/dashboard');
    })->name('dashboard');

    Route::controller(\App\Http\Controllers\Rooms\RoomSessionController::class)->group(function () {
        Route::get('room-session', 'showRoomSessionPaginate')->name('room.session.page');
        Route::get('add-room-session', 'addRoomSession')->name('add.room.session.page');
    });

    Route::controller(\App\Http\Controllers\Rooms\RoomReservationController::class)->group(function () {
        Route::get('room-reservation', 'showRoomReservationWithUserAndRoomPaginate')->name('room.reservation.with.user.and.room.information.page');
        Route::get('room-reservation-json', 'roomReservationJson');
        Route::get('add-room-reservation', 'addRoomReservation')->name('add.room.reservation.page');
    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

require __DIR__ . '/custom/static_pages.php';
require __DIR__ . '/custom/rooms.php';
require __DIR__ . '/custom/authorization.php';
