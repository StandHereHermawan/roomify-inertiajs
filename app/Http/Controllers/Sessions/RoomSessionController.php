<?php

namespace App\Http\Controllers\Sessions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\RoomSessionIndexRequest;
use App\Models\RoomSession;
use App\Services\RoomSessionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomSessionController extends Controller
{
    public function __construct(
        private RoomSessionService $room_service
    ) {
    }

    public function showRoomSessionPaginate(RoomSessionIndexRequest $request)
    {
        // $page = $this
        //     ->room_service
        //     ->roomSessionPages(
        //         $request->validated()[RoomSessionIndexRequest::PER_PAGE],
        //         RoomSessionIndexRequest::PAGE,
        //         $request->validated()[RoomSessionIndexRequest::PAGE],
        //     );

        $page = RoomSession::paginate(
            $request->validated()[RoomSessionIndexRequest::PER_PAGE],
            ['*'],
            RoomSessionIndexRequest::PAGE,
            $request->validated()[RoomSessionIndexRequest::PAGE]
        )->withQueryString();

        return Inertia::render('room/session/page', [RoomSessionIndexRequest::PAGE => $page]);
    }
}
