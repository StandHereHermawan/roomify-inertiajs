<?php

namespace Tests\Feature\Room;

use App\Models\Room;
use App\Models\RoomReservation;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertSame;

class RoomReservationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $room_reservation_service;
    protected $room_service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->room_reservation_service = $this->app->make(\App\Services\RoomReservationService::class);
        $this->room_service = $this->app->make(\App\Services\RoomService::class);
    }

    /**
     * 
     */
    public function test_it_should_singleton(): void
    {
        $service_1 = $this->app->make(\App\Services\RoomReservationService::class);
        $service_2 = $this->app->make(\App\Services\RoomReservationService::class);

        $service_3 = $this->app->make(\App\Services\RoomService::class);
        $service_4 = $this->app->make(\App\Services\RoomService::class);

        assertSame($service_1, $service_2);
        assertSame($service_3, $service_4);
    }

    /**
     * 
     */
    public function test_it_should_success_create_room_reservation(): void
    {
        $room_data = [
            Room::NAME => 'Ruang Biasa',
            Room::CODE => "B-352",
            Room::FLOOR_WIDE_IN_METER_SQUARED => '10.5',
            Room::HEIGHT_IN_METER => '2.5',
        ];

        $room_record = $this->room_service->create($room_data);

        $user_data = [
            User::NAME => 'Terry Andrew Davis',
            User::EMAIL => "terry.1@localhost.com",
            User::PASSWORD => Hash::make('Rahasia'),
        ];

        $user_record = User::create($user_data);

        assertNotNull($room_record);
        assertEquals($room_record[Room::NAME], $room_data[Room::NAME]);

        $room_reservation_data = [
            RoomReservation::ROOM_ID => $room_record[Room::ID],
            RoomReservation::USER_ID => $user_record[User::ID],
            RoomReservation::RESERVATION_DATE => Carbon::now(),
            RoomReservation::STATUS => RoomReservation::STATUS_ACCEPTED,
            RoomReservation::DETERMINED_AT => Carbon::now(),
            RoomReservation::CREATED_AT => Carbon::now(),
            RoomReservation::UPDATED_AT => Carbon::now(),
        ];

        $room_reservation_record = $this->room_reservation_service->create($room_reservation_data);

        assertNotNull($room_reservation_record);
        assertEquals($room_record[Room::ID], $room_reservation_record[RoomReservation::ROOM_ID]);
    }
}
