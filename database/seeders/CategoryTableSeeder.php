<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 2; $i++) {
            Category::create([
                'name' => $faker->words(2, true),
                'is_visible' => $faker->boolean,
                'img_url' => $faker->imageUrl(),
                'sort_number' => $i + 1,
                'section_id' => $faker->numberBetween(1, 2)
            ]);
        }
    }
}
