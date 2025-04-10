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

    public function show($videoId)
    {
        $video = Video::with(['comments.user'])->findOrFail($videoId);
        return view('video', compact('video'));
    }

    public function destroy($commentId)
    {
        $comment = CommentRate::findOrFail($commentId);
        
        if (Auth::id() === $comment->UID || Auth::user()->is_admin) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully');
        }
        
        return back()->with('error', 'You are not authorized to delete this comment');
    }
}

