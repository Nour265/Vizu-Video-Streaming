<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRate;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class CommentRateController extends Controller
{
    public function store(Request $request, $videoId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $existing = CommentRate::where('VidID', $videoId)
                    ->where('UID', Auth::id())
                    ->first();

        if ($existing) {
            return back()->with('error', 'You have already rated/commented on this video.');
        }

        CommentRate::create([
            'VidID' => $videoId,
            'UID' => Auth::id(),
            'comment_text' => $request->comment_text,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }

    // Show all comments for a video
    public function show($videoId)
    {
        $video = Video::with(['comments.user'])->findOrFail($videoId);
        return view('video', compact('video'));
    }

    // Delete a comment
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

