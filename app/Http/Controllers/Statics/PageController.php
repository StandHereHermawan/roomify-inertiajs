<?php

namespace App\Http\Controllers\Statics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function dashboard07() {
        return Inertia::render('template/dashboard07/page');
    }

    public function sidebar01() {
        return Inertia::render('template/sidebar01/page');
    }

    public function sidebar11() {
        return Inertia::render('template/sidebar11/page');
    }
}
