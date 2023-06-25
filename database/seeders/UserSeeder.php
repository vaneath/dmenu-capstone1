<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'test',
            'email' => 'test@test.com',
            ]);

        User::factory()->create([
            'id' => Str::random(10),
            'role' => 'superadmin',
            'name' => 'Vaneath',
            'email' => 'vaneath@gmail.com',
        ]);
    }
}
