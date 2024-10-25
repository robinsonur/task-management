<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        $record_type_id = \App\Models\RecordType::inRandomOrder()->first()->id;
        $name = $this->faker->sentence();

        return [
            'record_type_id' => $record_type_id,
            'description' => $name
        ];

    }

}
