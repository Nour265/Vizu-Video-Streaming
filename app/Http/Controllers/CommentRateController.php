<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRate;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class CommentRateController extends Controller
{
    // ✅ Store a new comment & rating
    public function store(Request $request, $videoId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        CommentRate::create([
            'VidID' => $videoId,
            'UID' => Auth::id(),
            'comment_text' => $request->comment_text,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    // ✅ Show all comments for a video
    public function show($videoId)
    {
        $video = Video::findOrFail($videoId);
        $comments = CommentRate::where('VidID', $videoId)->latest()->get();

        return view('videos.comments', compact('video', 'comments'));
    }

    // ✅ Delete a comment
    public function destroy($commentId)
    {
        $comment = CommentRate::findOrFail($commentId);
        
        if ($comment->UID == Auth::id()) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        }

        return back()->with('error', 'Unauthorized action.');
    }
}

