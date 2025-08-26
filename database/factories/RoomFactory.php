<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room_code = fake()->unique(false, 100000)->randomElement(
            [
                ('B-' . random_int(100, 120)),
                ('B-' . random_int(200, 220)),
                ('B-' . random_int(300, 320)),
                ('B-' . random_int(400, 420)),
                ('B-' . random_int(500, 520)),
                ('B-' . random_int(600, 620)),
            ]
        );

        return [
            Room::NAME => fake()->randomElement(['Lab', 'Ruang Biasa', 'Fasilitas']),
            Room::CODE => $room_code,
            Room::HEIGHT_IN_METER => fake()->randomFloat(1, 3,4),
            Room::FLOOR_WIDE_IN_METER_SQUARED => fake()->randomFloat(2, 10, 20),
        ];
    }
}
