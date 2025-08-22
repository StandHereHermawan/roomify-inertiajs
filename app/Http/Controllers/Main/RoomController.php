<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function show() {
        return Inertia::render('room/page');
    }
}
