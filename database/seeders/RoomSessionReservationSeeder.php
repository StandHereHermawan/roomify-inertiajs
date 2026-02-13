<?php

namespace Database\Seeders;

use App\Dummies\RoomDataExamples;
use App\Dummies\UserDataExamples;
use App\Models\Room;
use App\Models\RoomReservation;
use App\Models\RoomSession;
use App\Models\RoomSessionReservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoomSessionReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::firstOrCreate(
            [User::EMAIL => UserDataExamples::SUPER_ADMIN_EMAIL_DUMMY], // Kolom untuk pengecekan
            User::factory()->superAdmin()->raw() // Data yang dibuat jika tidak ditemukan
        );

        $room = Room::firstOrCreate(
            [Room::CODE => RoomDataExamples::ROOM_CODE_B_203],
            Room::factory()->roomB203()->raw()
        );

        $roomSession_7_00_am = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(0)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(0)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(7)->setMinute(49)->setSecond(59)->format('H:i:s'),
        ]);

        $roomSession_7_50_am = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(50)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(50)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(8)->setMinute(39)->setSecond(59)->format('H:i:s'),
        ]);

        $roomSession_8_40_am = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(8)->setMinute(40)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::SESSION_START => Carbon::today()->setHour(8)->setMinute(40)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(9)->setMinute(29)->setSecond(59)->format('H:i:s'),
        ]);

        $roomReservation = RoomReservation::firstOrCreate(
            [
                RoomReservation::USER_ID => $users->getId(),
                RoomReservation::RESERVATION_DATE => now()->addDay()->toDateTime(),
                RoomReservation::ROOM_ID => $room->getId()
            ],
            [
                RoomReservation::USER_ID => $users->getId(),
                RoomReservation::RESERVATION_DATE => now()->addDay()->toDateTime(),
                RoomReservation::ROOM_ID => $room->getId()
            ]
        );

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservation->getId(),
            // RoomSessionReservation::USER_ID => $users->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_00_am->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservation->getId(),
            // RoomSessionReservation::USER_ID => $users->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_00_am->getId()
        ]);

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservation->getId(),
            // RoomSessionReservation::USER_ID => $users->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_50_am->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservation->getId(),
            // RoomSessionReservation::USER_ID => $users->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_50_am->getId()
        ]);

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservation->getId(),
            // RoomSessionReservation::USER_ID => $users->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_8_40_am->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservation->getId(),
            // RoomSessionReservation::USER_ID => $users->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_8_40_am->getId()
        ]);
    }
}
