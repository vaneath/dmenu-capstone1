<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 2; $i++) {
            Section::create([
                'name' => $faker->words(2, true),
                'is_visible' => $faker->boolean,
                'sort_number' => $i + 1,
                'restaurant_id' => $faker->numberBetween(1, 2),
            ]);
        }
    }
}
