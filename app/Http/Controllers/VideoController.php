<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // ✅ Search videos by title only (case-insensitive)
        $videos = Video::where('title', 'LIKE', "%{$query}%")->get();

        return view('videos.search', compact('videos', 'query'));
    }
}

