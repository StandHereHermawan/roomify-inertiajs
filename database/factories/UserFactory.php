<?php

namespace Database\Factories;

use App\Dummies\UserDataExamples;
use App\Enums\EnumsRole;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            User::NAME => fake()->name(),
            User::EMAIL => fake()->unique()->safeEmail(),
            User::EMAIL_VERIFIED_AT => now(),
            User::PASSWORD => static::$password ??= Hash::make('password'),
            User::REMEMBER_TOKEN => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            User::EMAIL_VERIFIED_AT => null,
        ]);
    }

    public function terryandrewdavis(): static
    {
        return $this->state(fn(array $attributes) => [
            User::NAME => 'Terry Andrew Davis',
            User::EMAIL => 'terry@localhost.com',
            User::EMAIL_VERIFIED_AT => now(),
            User::PASSWORD => Hash::make('Rahasia'),
            User::REMEMBER_TOKEN => Str::random(10),
        ]);
    }

    public function superAdmin(): static
    {
        return $this->state(fn(array $attributes) => [
            User::NAME => EnumsRole::SUPER_ADMIN->value,
            User::EMAIL => UserDataExamples::SUPER_ADMIN_EMAIL_DUMMIES,
            User::EMAIL_VERIFIED_AT => now(),
            User::PASSWORD => Hash::make('password'),
            User::REMEMBER_TOKEN => Str::random(10),
        ]);
    }

    public function superAdminWithRole(): static
    {
        return $this->state(fn(array $attributes) => [
            User::NAME => EnumsRole::SUPER_ADMIN->value,
            User::EMAIL => UserDataExamples::SUPER_ADMIN_EMAIL_DUMMIES,
            User::EMAIL_VERIFIED_AT => now(),
            User::PASSWORD => Hash::make('password'),
            User::REMEMBER_TOKEN => Str::random(10),
        ])->afterCreating(function (User $user) {
            // Relasi ini hanya dibuat jika ->superAdmin() dipanggil
            $roleAdmin = Role::where(Role::NAME, EnumsRole::SUPER_ADMIN->value)->first() ??
                Role::create([Role::NAME => EnumsRole::SUPER_ADMIN->value]);
            $user->roles()->syncWithoutDetaching([$roleAdmin->id]);
        });
    }

    public function hasVisitorRole(): static
    {
        return $this->afterCreating(function (User $user) {
            // Relasi ini hanya dibuat jika ->superAdmin() dipanggil
            $roleAdmin = Role::where(Role::NAME, EnumsRole::VISITOR->value)->first() ??
                Role::create([Role::NAME => EnumsRole::VISITOR->value]);
            $user->roles()->syncWithoutDetaching([$roleAdmin->id]);
        });
    }
}
