<?php

namespace Database\Seeders;

use App\Models\RoomSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RoomSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tentukan waktu mulai sesi pertama yang menjadi acuan.
        $firstSessionStartTime = '07:00:00';

        // 1. Cek apakah sesi yang dimulai pukul 07:00 sudah ada di database.
        $sessionExists = RoomSession::where(RoomSession::SESSION_START, $firstSessionStartTime)->first();

        // 2. Jika sudah ada, tampilkan pesan dan hentikan proses seeder ini.
        if ($sessionExists) {
            Log::info('Data Room Sessions sudah ada. Proses seeding dilewati.');
            return;
        }

        // 3. Jika belum ada, panggil factory untuk membuat data sesi baru.
        // Anda bisa menentukan berapa banyak sesi yang ingin dibuat di sini.
        // Contoh: Membuat 12 sesi berurutan.
        Log::info('Membuat data Room Sessions baru...');
        RoomSession::factory(12)->create();

        Log::info('Seeding Room Sessions selesai.');
    }
}
