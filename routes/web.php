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

    Route::controller(\App\Http\Controllers\Rooms\RoomSessionController::class)->group(function () {
        Route::get('room-session', 'showRoomSessionPaginate')->name('room.session.page');
        Route::get('add-room-session', 'addRoomSession')->name('add.room.session.page');
    });

    Route::controller(\App\Http\Controllers\Rooms\RoomController::class)->group(function () {
        Route::get('room', 'showRoomPaginate')->name('room.page');
        Route::get('add-room', 'addRoom')->name('add.room.page');
    });

    Route::controller(\App\Http\Controllers\Rooms\RoomReservationController::class)->group(function () {
        Route::get('room-reservation', 'showRoomReservationPaginate')->name('room.reservation.page');
        Route::get('room-reservation-2', 'showRoomReservationWithUserAndRoomPaginate')->name('room.reservation.with.user.and.room.information.page');
        Route::get('add-room-reservation', 'addRoomReservation')->name('add.room.reservation.page');
    });

    Route::controller(\App\Http\Controllers\Users\UserController::class)->group(function () {
        Route::get('users', 'showUserPagination')->name('user.page');
    });

    Route::controller(\App\Http\Controllers\Users\UserWithRoleController::class)->group(function () {
        Route::get('users-with-role', 'showUserWithRolePagination')->name('user.with.role.page');
    });

    Route::controller(\App\Http\Controllers\Users\UserSessionController::class)->group(function () {
        Route::get('users-session', 'showUserSessionPagination')->name('user.session.page');
    });

    Route::controller(\App\Http\Controllers\Users\RoleController::class)->group(function () {
        Route::get('roles', 'rolePagination')->name('role.page');
        Route::get('add-role', 'addRole')->name('add.role.page');

    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/static_pages.php';
