<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poll>
 */
class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'target_user_type' => $this->faker->randomElement(['owner', 'tenant', 'all']),
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
