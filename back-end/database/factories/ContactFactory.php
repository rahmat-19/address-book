<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ContactFactory extends Factory
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
            'name' => fake()->name(),
            'phone_number' => fake()->numerify('62###########'), // Generate nomor telepon dengan 10 digit angka
            'active' => fake()->numberBetween(0, 1), // Generate angka acak antara 0 dan 1
            'user_id' => fake()->numberBetween(1, 2), // Generate angka acak antara 0 dan 1
            'address' => fake()->address(),
            'category' => fake()->randomElement(['family', 'friend', 'work']),
            
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
