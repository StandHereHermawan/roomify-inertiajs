<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomIndexRequest;
use App\Models\Room;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function showRoomPaginate(RoomIndexRequest $request)
    {
        $page = Room::paginate(
            $request->validated()[RoomIndexRequest::PER_PAGE],
            ['*'],
            RoomIndexRequest::PAGE,
            $request->validated()[RoomIndexRequest::PAGE]
        )->withQueryString();

        return Inertia::render('room/page', [RoomIndexRequest::PAGE => $page, RoomIndexRequest::PER_PAGE => $request->validated()[RoomIndexRequest::PER_PAGE]]);
    }
}
