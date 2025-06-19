<?php

namespace Database\Factories;

use App\Enums\ApplicationDepartmentEnum;
use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'type' => fake()->randomElement(ApplicationTypeEnum::values()),
            'department' => fake()->randomElement(ApplicationDepartmentEnum::values()),
            'status' => fake()->randomElement(ApplicationStatusEnum::values()),
            'title' => fake()->realText(),
            'content' => fake()->text()
        ];
    }
}
