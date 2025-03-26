<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // Manage Users
    public function manageUsers(Request $request)
    {
        $users = User::all(); // Get all users
        return view('admin.manage-users.manage-users', compact('users'));
    }

    // Manage Videos
    public function manageVideos(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $videos = Video::where('title', 'like', '%' . $query . '%')->paginate(10);
        } else {
            $videos = Video::paginate(10);
        }
        return view('admin.manage-videos.manage-videos', compact('videos'));
    }
    public function dashboard()
    {
        return view('admin.dashboard'); // Make sure this view exists in resources/views/admin/dashboard.blade.php
    }

    public function editUser(User $user)
    {
        return view('admin.manage-users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->UID . ',UID',
            'role' => 'required|in:admin,user',
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer',
        ]);

        $user->update($validated);
        return redirect()->route('admin.manage.users')->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.manage.users')->with('success', 'User deleted successfully!');
    }
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('username', 'LIKE', "%{$query}%")->get();
        return view('admin.manage-users.manage-users', compact('users'));
    }
    public function searchVideos(Request $request)
    {
        $query = $request->input('query');
        $videos = Video::where('title', 'like', '%' . $query . '%')->paginate(10);
        return view('video.show', compact('video'));
    }


    public function viewVideo($id)
    {
        $video = Video::where('VidID', $id)->firstOrFail();
        return view('admin.manage-videos.view', ['video' => $video]);
    }

}
