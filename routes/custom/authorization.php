<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(\App\Http\Controllers\Users\UserController::class)->group(function () {
        Route::get('users', 'showUserPagination')->name('user.page');
    });

    Route::controller(\App\Http\Controllers\Users\UserWithRoleController::class)->group(function () {
        Route::get('users-with-role', 'showUserWithRolePagination')->name('user.with.role.page');
        Route::get('users-with-role-json', 'userWithRole');
    });

    Route::controller(\App\Http\Controllers\Users\UserSessionController::class)->group(function () {
        Route::get('users-session', 'showUserSessionPagination')->name('user.session.page');
        Route::get('users-session-json', 'userSessionJson');
    });

    Route::controller(\App\Http\Controllers\Users\RoleController::class)->group(function () {
        Route::get('roles', 'rolePagination')->name('role.page');
        Route::get('add-role', 'addRole')->name('add.role.page');
    });
});
