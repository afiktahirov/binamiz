<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PollAnswer>
 */
class PollAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id' => \App\Models\PollQuestion::factory(),
            'answer' => $this->faker->sentence(),
            // 'votes_count' => $this->faker->numberBetween(0, 100), // If you want to simulate votes
        ];
    }
}
