<?php

namespace Database\Factories;

use App\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'status' => TaskStatus::PENDING,
            'order' => (static::newModel()->max('order') ?? 0) + 1,
        ];
    }
}
