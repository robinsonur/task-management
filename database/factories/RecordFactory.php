<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RecordType;

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

        $record_type_id = RecordType::inRandomOrder()->first()->id;
        $description = $this->faker->sentence();

        return [
            'record_type_id' => $record_type_id,
            'description' => $description
        ];

    }

}
