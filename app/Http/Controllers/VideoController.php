<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');
    $videos = Video::where('title', 'like', '%' . $query . '%')->get();

    // If AJAX, return partial view
    if ($request->ajax()) {
        return view('partials.search-results', compact('videos'))->render();
    }

    // Fallback if not AJAX
    return view('videos.search', compact('videos', 'query'));
}


    public function show($id)
    {
        $video = Video::where('VidID', $id)->firstOrFail();  // Get the video by ID
        return view('video.show', compact('video'));  // Pass video data to the view
    }

    

}

