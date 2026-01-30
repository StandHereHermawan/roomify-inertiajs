<?php

namespace Tests\Feature\Room;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\RoomSession;
use App\Models\Room;
use Database\Seeders\RoomSessionSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertSame;

class RoomSessionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(\App\Services\RoomSessionService::class);
    }

    /**
     * 
     */
    public function test_it_should_singleton(): void
    {
        $service_1 = $this->app->make(\App\Services\RoomSessionService::class);
        $service_2 = $this->app->make(\App\Services\RoomSessionService::class);

        assertSame($service_1, $service_2);
    }

    /**
     * 
     */
    public function test_it_should_success_create_room(): void
    {
        $data = [
            RoomSession::SESSION_START => '07:00:00',
            RoomSession::SESSION_END => "07:39:59"
        ];

        $record = $this->service->create($data);

        assertNotNull($record);
        assertEquals($record[RoomSession::SESSION_START], $data[RoomSession::SESSION_START]);
    }

    /**
     * 
     */
    public function test_it_should_success_update_room(): void
    {
        $data = [
            RoomSession::SESSION_START => '07:00:00',
            RoomSession::SESSION_END => '07:29:59'
        ];

        $record = $this->service->create($data);

        $data_update = [
            RoomSession::SESSION_START => '07:00:00',
            RoomSession::SESSION_END => '07:39:59'
        ];

        $updated_record = $this->service->update($record, $data_update);

        assertNotNull($updated_record);
        assertEquals($record[RoomSession::ID], $updated_record[RoomSession::ID]);
        assertNotEquals($data[RoomSession::SESSION_END], $updated_record[RoomSession::SESSION_END]);
    }

    /**
     * 
     */
    public function test_it_should_success_delete_room(): void
    {
        $data = [
            RoomSession::SESSION_START => '07:00:00',
            RoomSession::SESSION_END => '07:29:59'
        ];

        $record = $this->service->create($data);
        assertNotNull($record);
        assertEquals($record[RoomSession::SESSION_START], $data[RoomSession::SESSION_START]);

        $deleted_record = $this->service->delete($record);

        $this->expectException(ModelNotFoundException::class);
        Room::where(
            RoomSession::ID,
            '=',
            $deleted_record[RoomSession::ID]
        )->firstOrFail();
    }

    /**
     * 
     */
    public function test_it_should_success_paginate_room_pages(): void
    {
        DB::transaction(function () {
            $this->seed([RoomSessionSeeder::class]);
        });

        $page = $this->service->roomSessionPages(5, 'room_session_pages', 1);

        // dd(json_encode($page, JSON_PRETTY_PRINT));
        assertNotNull($page);
    }
}
