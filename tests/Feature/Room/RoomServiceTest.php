<?php

namespace Tests\Feature\Room;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertSame;

class RoomServiceTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(\App\Services\RoomService::class);
    }

    /**
     * 
     */
    public function test_it_should_singleton(): void
    {
        $service_1 = $this->app->make(\App\Services\RoomService::class);
        $service_2 = $this->app->make(\App\Services\RoomService::class);

        assertSame($service_1, $service_2);
    }

    /**
     * 
     */
    public function test_it_should_success_create_room(): void
    {
        $data = [
            Room::NAME => 'Ruang Biasa',
            Room::CODE => "B-352",
            Room::FLOOR_WIDE_IN_METER_SQUARED => '10.5',
            Room::HEIGHT_IN_METER => '2.5',
        ];

        $record = $this->service->create($data);

        assertNotNull($record);
        assertEquals($record[Room::NAME], $data[Room::NAME]);
    }

    /**
     * 
     */
    public function test_it_should_success_update_room(): void
    {
        $data_old = [
            Room::NAME => 'Ruang Biasa',
            Room::CODE => "B-352",
            Room::FLOOR_WIDE_IN_METER_SQUARED => '10.5',
            Room::HEIGHT_IN_METER => '2.5',
        ];

        $model = Room::create($data_old);

        $data = [
            Room::NAME => 'Ruang Biasa Update',
            Room::CODE => "B-352",
            Room::FLOOR_WIDE_IN_METER_SQUARED => '10.5',
            Room::HEIGHT_IN_METER => '2.5',
        ];

        $record = $this->service->update($model, $data);

        assertNotNull($record);
        assertNotEquals($record[Room::NAME], $data_old[Room::NAME]);
        assertEquals($record[Room::NAME], $data[Room::NAME]);
    }

    /**
     * 
     */
    public function test_it_should_success_delete_room(): void
    {
        $data_old = [
            Room::NAME => 'Ruang Biasa',
            Room::CODE => "B-352",
            Room::FLOOR_WIDE_IN_METER_SQUARED => '10.5',
            Room::HEIGHT_IN_METER => '2.5',
        ];

        $model = Room::create($data_old);

        $this->service->delete($model);

        $this->expectException(ModelNotFoundException::class);
        Room::where(Room::ID, '=', $model[Room::ID])->firstOrFail();
    }

    /**
     * 
     */
    public function test_it_should_success_room_pages(): void
    {
        DB::transaction(function () {
            \App\Models\Room::factory()->count(50)->create();
        });

        $page = $this->service->roomPages(5, 'room_pages', 2);

        assertNotNull($page);
        $json = json_encode($page, JSON_PRETTY_PRINT);
        echo "$json";
    }
}
