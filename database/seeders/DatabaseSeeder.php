<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoomSeeder::class,
            UserSeeder::class,
            RoomSessionSeeder::class,
            RoleSeeder::class,
            RoomSessionReservationSeeder::class
        ]);
    }
}
