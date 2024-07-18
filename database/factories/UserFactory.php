<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'username' => $this->faker->unique()->userName,
            'password' => static::$password ??= Hash::make('password'),
            'email' => $this->faker->unique()->safeEmail,
            'oauth_provider' => null,
            'oauth_uid' => null,
            'oauth_token' => null,
            'oauth_refresh_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}

