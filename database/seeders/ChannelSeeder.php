<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;
use App\Models\User;

class ChannelSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Channel::create([
                'UID' => $user->UID,
                'sub_count' => rand(10, 5000),
                'description' => 'This is a sample channel for user ' . $user->username,
                'is_creator' => 1,
            ]);
        }

        echo "✅ Seeded " . count($users) . " channels successfully!\n";
    }
}
