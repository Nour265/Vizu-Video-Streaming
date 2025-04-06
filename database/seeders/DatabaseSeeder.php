<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,         // Users first
            ChannelSeeder::class,      // Channels depend on users
            VideoSeeder::class,        // Videos depend on channels
            CommentRateSeeder::class,  // Comments depend on videos & users
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
