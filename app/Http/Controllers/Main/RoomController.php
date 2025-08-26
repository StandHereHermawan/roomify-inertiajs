<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomIndexRequest;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function __construct(
        private RoomService $room_service
    ) {
    }

    public function showRoomPaginate(RoomIndexRequest $request)
    {
        $page = $this
            ->room_service
            ->roomPages(
                $request->validated()[RoomIndexRequest::PER_PAGE],
                RoomIndexRequest::PAGE,
                $request[RoomIndexRequest::PAGE],
            );
        return Inertia::render('room/page', [RoomIndexRequest::PAGE => $page]);
    }
}
