<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\RoomSessionIndexRequest;
use App\Models\RoomSession;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class RoomSessionController extends Controller
{
    public function showRoomSessionPaginate(RoomSessionIndexRequest $request)
    {
        $page = RoomSession::paginate(
            $request->validated()[RoomSessionIndexRequest::PER_PAGE],
            ['*'],
            RoomSessionIndexRequest::PAGE,
            $request->validated()[RoomSessionIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return Inertia::render('room/session', [RoomSessionIndexRequest::PAGE => $page]);
    }
}
