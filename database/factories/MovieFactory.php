<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(4, true),
            'description' => fake()->paragraph(),
            'release_date' => fake()->dateTime(),
            'rating' => fake()->numberBetween(0,5),
            'image' => fake()->url()
        ];
    }
}
