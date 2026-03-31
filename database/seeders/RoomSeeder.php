<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            Log::debug('Membuat Data Sintetik Tabel Room...');
            Room::factory()->count(16)->hasTwoImage()->create();
            Log::debug('Membuat Data Sintetik Tabel Room Selesai.');
        });
    }
}
