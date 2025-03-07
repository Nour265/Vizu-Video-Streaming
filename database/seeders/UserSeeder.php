<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete(); // Deletes all existing users but keeps auto-increment

        // Insert a default user
        User::create([
            'role' => 'user',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), // Securely hash the password
            'username' => 'testuser',
            'age' => 25,
            'gender' => 'male',
            'date_joined' => now(),
            'profile_picture' => null,
        ]);
    }
}

