<?php

namespace Database\Factories;

use App\Models\RoomSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomSession>
 */
class RoomSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = RoomSession::class;

    /**
     * @var \Illuminate\Support\Carbon|null Waktu mulai untuk sesi berikutnya.
     * Variabel ini 'mengingat' state di antara panggilan factory.
     */
    protected static ?Carbon $nextSessionStart = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. Inisialisasi waktu awal jika ini adalah panggilan pertama kali
        // Factory akan dijalankan berulang kali, sekali untuk setiap record yang dibuat.
        if (is_null(self::$nextSessionStart)) {
            self::$nextSessionStart = Carbon::today()->setHour(7)->setMinute(0)->setSecond(0);
        }

        // 2. Tentukan waktu mulai dan selesai untuk sesi SAAT INI
        $sessionStart = self::$nextSessionStart->copy();
        $sessionEnd = $sessionStart->copy()->addMinutes(50);

        // 3. PENTING: Perbarui static variable untuk persiapan sesi BERIKUTNYA
        self::$nextSessionStart = $sessionEnd->copy();

        // 4. Kembalikan data untuk record saat ini
        return [
            RoomSession::SESSION_START => $sessionStart->format('H:i:s'),
            RoomSession::SESSION_END => $sessionEnd->format('H:i:s'),
        ];
    }
}
