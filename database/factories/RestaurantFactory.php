<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'currency' => fake()->randomElement(['USD', 'KHR']),
            'location' => fake()->address(),
            'no_of_tables' => fake()->numberBetween(1, 10),
            'no_of_available_tables' => fake()->numberBetween(1, 10),
            'unique_id' => fake()->unique()->numberBetween(1, 10),
            'user_id' => 1,
        ];
    }
}
