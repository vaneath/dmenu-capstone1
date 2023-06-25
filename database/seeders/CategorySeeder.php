<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'id' => 1,
            'tag_id' => 1,
        ]);
        Category::factory()->create([
            'id' => 2,
            'tag_id' => 2,
        ]);
        Category::factory()->create([
            'id' => 3,
            'tag_id' => 3,
        ]);
        Category::factory()->create([
            'id' => 4,
            'tag_id' => 1,
        ]);
        Category::factory()->create([
            'id' => 5,
            'tag_id' => 2,
        ]);
        Category::factory()->create([
            'id' => 6,
            'tag_id' => 3,
        ]);
    }
}
