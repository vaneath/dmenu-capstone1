<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'id' => 1,
            'name' => $this->faker->name(),
            'table_amount' => $this->faker->numberBetween(1, 10),
            'bg_img_url' => 'default/restaurant.jpg',
            'logo_url' => 'default/logo.jpg',
            'qr_code_url' => $this->faker->imageUrl(),
            'khqr_url' => $this->faker->imageUrl(),
            'home_address' => $this->faker->address(),
            'street_address' => $this->faker->streetAddress(),
            'commune' => $this->faker->city(),
            'district' => $this->faker->city(),
            'user_id' => 1,
        ];
    }
}
