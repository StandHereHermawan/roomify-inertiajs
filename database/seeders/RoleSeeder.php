<?php

namespace Database\Seeders;

use App\Enums\EnumsRole;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::where(Role::NAME, '=', EnumsRole::SUPER_ADMIN->value)->first() ?? Role::create([
            Role::NAME => EnumsRole::SUPER_ADMIN->value,
            Role::CREATED_AT => now(),
            Role::UPDATED_AT => now()
        ]);

        Role::where(Role::NAME, '=', EnumsRole::ADMIN->value)->first() ?? Role::create([
            Role::NAME => EnumsRole::ADMIN->value,
            Role::CREATED_AT => now(),
            Role::UPDATED_AT => now()
        ]);

        Role::where(Role::NAME, '=', EnumsRole::VISITOR->value)->first() ?? Role::create([
            Role::NAME => EnumsRole::VISITOR->value,
            Role::CREATED_AT => now(),
            Role::UPDATED_AT => now()
        ]);
    }
}
