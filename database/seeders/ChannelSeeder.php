<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChannelSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete(); // Deletes all existing channels

        // Ensure a user exists before inserting a channel
        $user = User::first();
        if (!$user) {
            $this->call(UserSeeder::class); // Calls UserSeeder if no users exist
            $user = User::first(); // Fetch the newly created user
        }

        // Insert a default channel
        Channel::create([
            'UID' => $user->UID, // Use the existing UID
            'sub_count' => 100,
            'description' => 'Default Channel',
            'is_creator' => 1,
            'date_created' => now(),
        ]);
    }
}
