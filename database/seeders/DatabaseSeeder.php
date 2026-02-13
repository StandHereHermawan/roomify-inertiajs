<?php

namespace Database\Seeders;

use App\Dummies\UserDataExamples;
use App\Enums\EnumsRole;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        DB::transaction(function () {
            $user = User::select()->where(User::NAME, '=', EnumsRole::SUPER_ADMIN->value)->first() ??
                User::factory()->create([
                    User::NAME => EnumsRole::SUPER_ADMIN->value,
                    User::PASSWORD => Hash::make('password'),
                    User::EMAIL => UserDataExamples::SUPER_ADMIN_EMAIL_DUMMY,
                ]);

            $role = Role::where(Role::NAME, '=', EnumsRole::SUPER_ADMIN->value)->first() ??
                Role::create([
                    Role::NAME => EnumsRole::SUPER_ADMIN->value
                ]);

            UserHasRole::where(UserHasRole::USER_ID, '=', $user->getId())->first() ?? UserHasRole::create([
                UserHasRole::USER_ID => $user->getId(),
                UserHasRole::ROLE_ID => $role->getId(),
            ]);
        });

        $this->call([
            RoomSeeder::class,
            RoomSessionSeeder::class,
            RoleSeeder::class,
            RoomSessionReservationSeeder::class
        ]);
    }
}
