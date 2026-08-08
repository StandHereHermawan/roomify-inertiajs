<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\CreateRoomRequest;
use App\Http\Requests\Room\RoomIndexRequest;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
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

        Log::debug($page);

        return Inertia::render(
            'room/index-page',
            [
                RoomIndexRequest::PAGE => $page,
                RoomIndexRequest::PER_PAGE => $request->validated()[RoomIndexRequest::PER_PAGE]
            ]
        );
    }

    public function showRoomPaginatePublic(RoomIndexRequest $request)
    {
        $page = Room::paginate(
            $request->validated()[RoomIndexRequest::PER_PAGE],
            ['*'],
            RoomIndexRequest::PAGE,
            $request->validated()[RoomIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return Inertia::render(
            'room/room-public',
            [
                RoomIndexRequest::PAGE => $page,
                RoomIndexRequest::PER_PAGE => $request->validated()[RoomIndexRequest::PER_PAGE]
            ]
        );
    }

    public function showRoomWithImagesPaginatePublicJson(RoomIndexRequest $request)
    {
        $page = Room::with('images')->
        paginate(
            $request->validated()[RoomIndexRequest::PER_PAGE],
            ['*'],
            RoomIndexRequest::PAGE,
            $request->validated()[RoomIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return $page;
    }

    public function showRoomJsonPaginate(RoomIndexRequest $request)
    {
        $page = Room::paginate(
            $request->validated()[RoomIndexRequest::PER_PAGE],
            ['*'],
            RoomIndexRequest::PAGE,
            $request->validated()[RoomIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return $page;
    }

    public function addRoomPage()
    {
        return Inertia::render('room/add-room');
    }

    public function createRoom(CreateRoomRequest $request)
    {
        $data = $request->validated();

        Log::debug(json_encode($data));

        $savedRecord = Room::create($data);

        Log::debug(json_encode($savedRecord));
    }
}
