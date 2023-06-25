<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()->create([
            'id' => 1,
        ]);
        Tag::factory()->create([
            'id' => 2,
        ]);
        Tag::factory()->create([
            'id' => 3,
        ]);
    }
}
