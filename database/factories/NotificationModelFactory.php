<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationModelFactory extends Factory
{
    protected $model = \App\Models\NotificationModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['informative', 'important']),
            'target_user_type' => $this->faker->randomElement(['owner', 'tenant', 'all']),
        ];
    }
}
