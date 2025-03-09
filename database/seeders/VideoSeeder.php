<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Channel;
use Faker\Factory as Faker;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $channels = Channel::all();

        foreach ($channels as $channel) {
            for ($i = 1; $i <= 5; $i++) { // Each channel gets 5 videos
                Video::create([
                    'CID' => $channel->CID,
                    'UID' => $channel->UID,
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraph,
                    'video_path' => 'videos/sample' . rand(1, 10) . '.mp4',
                    'thumbnail' => 'thumbnails/sample' . rand(1, 10) . '.jpg',
                    'length' => rand(60, 900),
                    'genre' => $faker->randomElement(['Comedy', 'Action', 'Drama', 'Horror']),
                    'view_count' => rand(100, 50000),
                ]);
            }
        }

        echo "✅ Seeded videos for all channels!\n";
    }
}

