<?php

namespace Database\Factories;

use App\Constants\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->userName(),
            'email' => fake()->email(),
            'bio' => fake()->text(150),
            'country' => fake()->country(),
            'type' => UserType::CLIENT,
            'message' => fake()->text(200),
            'image' => fake()->imageUrl(),
            'user_code' => random_int(000000000000000000,999999999999999999),
            'email_verified_at' => now(),
            'password' => Hash::make(fake()->password())
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
