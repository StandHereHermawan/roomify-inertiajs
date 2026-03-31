<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Statics\PageController::class)->group(function () {
    Route::get('dashboard-07', 'dashboard07')->name('dashboard07');
    Route::get('sidebar-01', 'sidebar01')->name('sidebar01');
    Route::get('sidebar-11', 'sidebar11')->name('sidebar11');
});
