<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;


class VideoController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');
    $videos = Video::where('title', 'like', '%' . $query . '%')->get();

    if ($request->ajax()) {
        return view('partials.search-results', compact('videos'))->render();
    }

    return view('videos.search', compact('videos', 'query'));
}

public function show($id, $CID)
{
    $video = Video::findOrFail($id);

    $channel = $video->channel;

    $name = $channel->name;
    $channelId = $channel->CID;

    $recommended = Video::where('VidID', '!=', $id)
                        ->inRandomOrder()
                        ->take(10)
                        ->get();

    $isSubscribed = Subscription::where('UID', Auth::user()->UID)
        ->where('CID', $channelId)
        ->exists();

    return view('video.show', compact('video', 'recommended', 'channelId', 'isSubscribed', 'name'));
}

public function store(Request $request)
{
    Log::info('Upload method hit!');
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'video_path' => 'required|mimes:mp4,mov,ogg,qt|max:200000',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);
    Log::info('Validation passed!');

    $videoFile = $request->file('video_path');
    $thumbnailFile = $request->file('thumbnail');

    $videoName = time() . '_' . $videoFile->getClientOriginalName();
    $thumbName = time() . '_' . $thumbnailFile->getClientOriginalName();

    $videoFile->move(public_path('videos'), $videoName);
    $thumbnailFile->move(public_path('thumbnails'), $thumbName);
    Log::info('Files moved: ' . $videoName . ', ' . $thumbName);

    $video = new Video([
        'CID' => Auth::id(),
        'UID' => Auth::id(),
        'title' => $request->title,
        'description' => $request->description ?? '',
        'video_path' => $videoName,
        'thumbnail' => 'thumbnails/' . $thumbName,
        'upload_date' => now(),
        'view_count' => 0,
        'genre'=> $request->genre ?? '',
        'length' => 0,
    ]);

    $video->save();
    Log::info('Video saved with ID: ' . $video->VidID);
    return response()->json(['success' => true, 'video_id' => $video->VidID]);
}

}

