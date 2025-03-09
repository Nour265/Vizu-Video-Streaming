<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        

        // Generate multiple fake users
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) { // Change 10 to any number you want
            User::create([
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
            ]);
        }

        echo "✅ Seeded 10 users successfully!\n"; // Debug message
    }
}

