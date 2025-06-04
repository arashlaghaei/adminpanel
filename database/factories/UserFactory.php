<?php

namespace Database\Factories;

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
            'username' => fake('fa_IR')->userName(),
            'email' => fake('fa_IR')->unique()->safeEmail(),
            'first_name' => fake('fa_IR')->firstName(),
            'last_name' => fake('fa_IR')->lastName(),
            'mobile' => fake('fa_IR')->phoneNumber(),
            'phone' => fake('fa_IR')->phoneNumber(),
            'gender' => fake()->randomElement(['male', 'female']),
            'birth_date' => fake()->date('Y-m-d', '2005-01-01'),
            'birth_place' => fake('fa_IR')->city(),
            'address' => fake('fa_IR')->address(),
            'type' => fake()->randomElement(['user']),
            'isAdmin' => 0,
            'api_token' => Str::random(128),
            'picture' => fake()->imageUrl(200, 200, 'people'),
            'status' => fake()->randomElement(['active', 'pending', 'banned']),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
