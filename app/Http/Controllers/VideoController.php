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
        $video = Video::findOrFail($id);

    // Fetch recommended videos (e.g., based on category or popularity)
    $recommended = Video::where('VidID', '!=', $id)
                        ->inRandomOrder() // Example sorting
                        ->take(10)
                        ->get();
    

    //dd($recommended);
    return view('video.show', compact('video', 'recommended'));
    }
}

