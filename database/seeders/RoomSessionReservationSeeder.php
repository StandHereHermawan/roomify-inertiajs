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
        $superAdmin = User::firstOrCreate(
            [User::EMAIL => UserDataExamples::SUPER_ADMIN_EMAIL_DUMMIES], // Kolom untuk pengecekan
            User::factory()->superAdmin()->raw() // Data yang dibuat jika tidak ditemukan
        );

        $roomB203 = Room::firstOrCreate(
            [Room::CODE => RoomDataExamples::ROOM_CODE_B_203],
            Room::factory()->roomB203()->raw()
        );

        $roomB211 = Room::firstOrCreate(
            [Room::CODE => RoomDataExamples::ROOM_CODE_B_211],
            Room::factory()->roomB211()->raw()
        );

        $roomSession_7_00 = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(0)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::factory()->session_7_00_00_to_7_49_59()->raw(),
        ]);

        $roomSession_7_50 = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(50)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::factory()->session_7_50_00_to_8_39_59()->raw(),
        ]);

        $roomSession_8_40 = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(8)->setMinute(40)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::factory()->session_8_40_00_to_9_29_59()->raw(),
        ]);

        $roomSession_12_50 = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(12)->setMinute(50)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::factory()->session_12_50_00_to_13_39_59()->raw(),
        ]);

        $roomSession_13_40 = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(13)->setMinute(40)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::factory()->session_13_40_00_to_14_29_59()->raw(),
        ]);

        $roomSession_14_30 = RoomSession::firstOrCreate([
            RoomSession::SESSION_START => Carbon::today()->setHour(14)->setMinute(30)->setSecond(0)->format('H:i:s'),
        ], [
            RoomSession::factory()->session_14_30_00_to_15_19_59()->raw(),
        ]);

        $roomReservationSuperAdminFirst = RoomReservation::firstOrCreate(
            [
                RoomReservation::USER_ID => $superAdmin->getId(),
                RoomReservation::RESERVATION_DATE => now()->addDay()->toDateTime()->format('Y-m-d'),
                // RoomReservation::DETERMINED_AT => now(),
                RoomReservation::ROOM_ID => $roomB203->getId()
            ],
            [
                RoomReservation::USER_ID => $superAdmin->getId(),
                RoomReservation::RESERVATION_DATE => now()->addDay()->toDateTime()->format('Y-m-d'),
                // RoomReservation::DETERMINED_AT => now(),
                RoomReservation::ROOM_ID => $roomB203->getId()
            ]
        );

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminFirst->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_00->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminFirst->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_00->getId()
        ]);

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminFirst->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_50->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminFirst->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_7_50->getId()
        ]);

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminFirst->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_8_40->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminFirst->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_8_40->getId()
        ]);

        $roomReservationSuperAdminSecond = RoomReservation::firstOrCreate(
            [
                RoomReservation::USER_ID => $superAdmin->getId(),
                RoomReservation::RESERVATION_DATE => now()->addDay()->toDateTime()->format('Y-m-d'),
                // RoomReservation::DETERMINED_AT => now(),
                RoomReservation::ROOM_ID => $roomB211->getId()
            ],
            [
                RoomReservation::USER_ID => $superAdmin->getId(),
                RoomReservation::RESERVATION_DATE => now()->addDay()->toDateTime()->format('Y-m-d'),
                // RoomReservation::DETERMINED_AT => now(),
                RoomReservation::ROOM_ID => $roomB211->getId()
            ]
        );

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminSecond->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_12_50->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminSecond->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_12_50->getId()
        ]);

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminSecond->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_13_40->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminSecond->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_13_40->getId()
        ]);

        RoomSessionReservation::firstOrCreate([
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminSecond->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_14_30->getId()
        ], [
            RoomSessionReservation::ROOM_RESERVATION_ID => $roomReservationSuperAdminSecond->getId(),
            RoomSessionReservation::ROOM_SESSION_ID => $roomSession_14_30->getId()
        ]);
    }
}
