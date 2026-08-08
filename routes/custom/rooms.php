<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Rooms\RoomController::class)->group(function () {
    Route::get('/', 'showRoomPaginatePublic')->name('home');
    Route::get('room-json', 'showRoomJsonPaginate');
    Route::get('room-with-image-json', 'showRoomWithImagesPaginatePublicJson');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(\App\Http\Controllers\Rooms\RoomController::class)->group(function () {
        Route::get('room', 'showRoomPaginate')->name('room.page');
        Route::get('add-room', 'addRoomPage')->name('add.room.page');
        Route::post('add-room', 'createRoom')->name('add.room');
    });

});
