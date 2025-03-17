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
    public function manageUsers()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.manage-users', compact('users'));
    }

    // Manage Videos
    public function manageVideos()
    {
        $videos = Video::all(); // Fetch all videos from the database
        return view('admin.manage-videos', compact('videos'));
    }
    public function dashboard()
    {
        return view('admin.dashboard'); // Make sure this view exists in resources/views/admin/dashboard.blade.php
    }
}
