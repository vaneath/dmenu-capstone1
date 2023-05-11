<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use Faker\Factory as Faker;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Item::create([
                'name' => $faker->words(4, true),
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 1, 100),
                'old_price' => $faker->randomFloat(2, 1, 100),
                'weight' => $faker->randomFloat(2, 0.1, 10),
                'is_visible' => $faker->boolean,
                'is_available' => $faker->boolean,
                'img_url' => $faker->imageUrl(),
                'sort_number' => $i + 1,
                'category_id' => $faker->numberBetween(1, 2),
            ]);
        }
    }
}
