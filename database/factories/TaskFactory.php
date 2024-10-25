<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        $name = $this->faker->title();
        $description = $this->faker->sentence();
        $dueDate = $this->faker->dateTimeBetween('-30 days', '+1 year');
        $statusId = \App\Models\Status::inRandomOrder()->first()->id;

        return [
            'name' => $name,
            'description' => $description,
            'due_date' => $dueDate,
            'status_id' => $statusId
        ];

    }

}
