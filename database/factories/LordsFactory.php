<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lords>
 */
class LordsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->name(),
            'house' => $this->faker->randomFloat(),
            'seasons_appeared' => ['Season 1', 'Season 2', 'Season 3'],
            'gender' => $gender,
            'titles' => $this->faker->title(),
            'aliases' => ['Fire', 'Ice', 'Got'],
            'interpretedBy' => $this->faker->userName()

        ];
    }
}
