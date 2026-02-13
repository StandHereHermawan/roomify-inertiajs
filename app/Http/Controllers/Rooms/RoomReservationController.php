<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomReservationIndexRequest;
use App\Models\RoomReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class RoomReservationController extends Controller
{
    public function showRoomReservationPaginate(RoomReservationIndexRequest $request)
    {
        $page = RoomReservation::paginate(
            $request->validated()[RoomReservationIndexRequest::PER_PAGE],
            ['*'],
            RoomReservationIndexRequest::PAGE,
            $request->validated()[RoomReservationIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return Inertia::render('room/reservation', [RoomReservationIndexRequest::PAGE => $page, RoomReservationIndexRequest::PER_PAGE => $request->validated()[RoomReservationIndexRequest::PER_PAGE]]);
    }
}
