<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomReservationIndexRequest;
use App\Models\Room;
use App\Models\RoomReservation;
use App\Models\User;
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

    public function showRoomReservationWithUserAndRoomPaginate(RoomReservationIndexRequest $request)
    {
        $page = RoomReservation::query()
            ->join(User::TABLE_NAME, 'sipr_room_reservations.user_id', '=', 'users.id')
            ->join(Room::TABLE_NAME, 'sipr_room_reservations.room_id', '=', 'sipr_rooms.id')
            ->select([
                'sipr_room_reservations.*',      // Semua kolom reservasi
                'users.name as user_name',       // Hanya nama user dengan alias
                'sipr_rooms.room_code'           // Hanya room_code
            ])
            ->paginate(
                $request->validated()[RoomReservationIndexRequest::PER_PAGE],
                ['*'],
                RoomReservationIndexRequest::PAGE,
                $request->validated()[RoomReservationIndexRequest::PAGE]
            )->withQueryString();

        Log::debug($page);

        return Inertia::render('room/reservation-with-user-and-room', [RoomReservationIndexRequest::PAGE => $page, RoomReservationIndexRequest::PER_PAGE => $request->validated()[RoomReservationIndexRequest::PER_PAGE]]);
    }

    public function addRoomReservation() {
        return Inertia::render('room/add-reservation');
    }
}
