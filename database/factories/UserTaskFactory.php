<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class UserTaskFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        $taskId = \App\Models\Task::inRandomOrder()->first()->id;
        $userId = \App\Models\User::inRandomOrder()->first()->id;

        return ['task_id' => $taskId, 'user_id' => $userId];

    }

}
