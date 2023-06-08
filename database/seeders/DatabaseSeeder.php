<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RestaurantsTableSeeder;
use Database\Seeders\SectionsTableSeeder;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\ItemsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

//        Restaurant::factory(20)->create();

         User::factory()->create([
             'name' => 'vaneath',
             'email' => 'vaneath@gmail.com',
         ]);
         User::factory()->create([
             'name' => 'pich',
             'email' => 'pich@gmail.com',
         ]);
         User::factory()->create([
             'name' => 'superadmin',
             'email' => 'superadmin@gmail.com',
             'role' => 'superadmin',
         ]);


//        $this->call([
//            RestaurantsTableSeeder::class,
//            SectionsTableSeeder::class,
//            CategoriesTableSeeder::class,
//            ItemsTableSeeder::class,
//        ]);
    }
}
