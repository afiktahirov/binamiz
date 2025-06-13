<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PollQuestion>
 */
class PollQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poll_id' => \App\Models\Poll::factory(),
            'question' => $this->faker->sentence(),
            // 'type' => $this->faker->randomElement(['single_choice', 'multiple_choice']),
            // 'required' => $this->faker->boolean(),
        ];
    }
}
