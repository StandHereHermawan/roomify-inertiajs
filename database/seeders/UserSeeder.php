<?php

namespace Database\Seeders;

use App\Dummies\UserDataExamples;
use App\Enums\EnumsRole;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create();
        User::factory(8)->hasVisitorRole()->create();

        DB::transaction(function () {
            $user = User::select()->where(User::NAME, '=', EnumsRole::SUPER_ADMIN->value)->first() ??
                User::factory()->create([
                    User::NAME => EnumsRole::SUPER_ADMIN->value,
                    User::PASSWORD => Hash::make('password'),
                    User::EMAIL => UserDataExamples::SUPER_ADMIN_EMAIL_DUMMIES,
                ]);

            $role_super_admin = Role::where(Role::NAME, '=', EnumsRole::SUPER_ADMIN->value)->first() ??
                Role::create([
                    Role::NAME => EnumsRole::SUPER_ADMIN->value
                ]);

            UserHasRole::where(UserHasRole::USER_ID, '=', $user->getId())->first() ??
                UserHasRole::create([
                    UserHasRole::USER_ID => $user->getId(),
                    UserHasRole::ROLE_ID => $role_super_admin->getId(),
                ]);
        });
    }
}
