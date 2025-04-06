<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommentRate;
use App\Models\User;
use App\Models\Video;
use Faker\Factory as Faker;

class CommentRateSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        $videos = Video::all();

        foreach ($videos as $video) {
            for ($i = 1; $i <= 10; $i++) { // Each video gets 10 comments
                CommentRate::create([
                    'VidID' => $video->VidID,
                    'UID' => $users->random()->UID,
                    'comment_text' => $faker->sentence,
                    'rating' => rand(1, 5), // 1 to 5 star rating
                ]);
            }
        }
        echo "Seeded comments and ratings for all videos!\n";
    }
}

