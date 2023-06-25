<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::factory()->create([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Burger',
            'description' => 'A delicious burger',
            'price' => 10.00,
            'img_url' => 'default/item.jpg',
            'category_id' => 1,
        ]);
    }
}
