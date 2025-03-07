<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\Channel;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    public function run()
    {
        DB::table('videos')->delete(); // Delete previous data but keep auto-increment

        // Ensure at least one channel exists before inserting videos
        $channel = Channel::first();
        if (!$channel) {
            $channel = Channel::create([
                'CID' => 1, // Ensure CID exists
                'UID' => 1, // Ensure UID exists
                'sub_count' => rand(0, 5000),
                'description' => 'Auto-created channel.',
                'is_creator' => 1,
                'date_created' => now(),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Video::create([
                'CID' => $channel->CID, // Use existing CID
                'UID' => 1, // Assuming UID = 1 exists
                'title' => "Sample Video $i",
                'description' => "This is a description for Sample Video $i.",
                'video_path' => "videos/sample$i.mp4",
                'thumbnail' => "thumbnails/sample$i.jpg",
                'length' => rand(60, 600),
                'upload_date' => now(),
                'genre' => ['Action', 'Comedy', 'Education', 'Music', 'Gaming'][rand(0, 4)],
                'view_count' => rand(100, 10000),
            ]);
        }
    }
}
