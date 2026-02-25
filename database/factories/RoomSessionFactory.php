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

    public function session_7_00_00_to_7_49_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(0)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(7)->setMinute(49)->setSecond(59)->format('H:i:s'),
        ]);
    }

    public function session_7_50_00_to_8_39_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(7)->setMinute(50)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(8)->setMinute(39)->setSecond(59)->format('H:i:s'),
        ]);
    }

    public function session_8_40_00_to_9_29_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(8)->setMinute(40)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(9)->setMinute(29)->setSecond(59)->format('H:i:s'),
        ]);
    }

    public function session_12_00_00_to_12_49_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(12)->setMinute(0)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(12)->setMinute(49)->setSecond(59)->format('H:i:s'),
        ]);
    }

    public function session_12_50_00_to_13_39_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(12)->setMinute(50)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(13)->setMinute(39)->setSecond(59)->format('H:i:s'),
        ]);
    }

    public function session_13_40_00_to_14_29_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(13)->setMinute(40)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(14)->setMinute(29)->setSecond(59)->format('H:i:s'),
        ]);
    }

    public function session_14_30_00_to_15_19_59(): static
    {
        return $this->state(fn(array $attributes) => [
            RoomSession::SESSION_START => Carbon::today()->setHour(14)->setMinute(30)->setSecond(0)->format('H:i:s'),
            RoomSession::SESSION_END => Carbon::today()->setHour(15)->setMinute(19)->setSecond(59)->format('H:i:s'),
        ]);
    }
}
