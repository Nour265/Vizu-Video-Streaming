<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;


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

}

