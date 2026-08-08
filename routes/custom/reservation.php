<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(\App\Http\Controllers\Rooms\RoomReservationController::class)->group(function () {
        Route::get('room-reservation', 'showRoomReservationWithUserAndRoomPaginate')->name('room.reservation.with.user.and.room.information.page');
        Route::get('room-reservation-json', 'roomReservationJson');
        Route::get('add-room-reservation', 'addRoomReservation')->name('add.room.reservation.page');
        Route::post('add-room-reservation', 'createRoomReservation')->name('add.room.reservation');
    });

});
