<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

// ✅ Home Page Route
Route::get('/', function () {
    $videos = Video::latest()->take(12)->get(); // Fetch 12 latest videos
    return view('home', compact('videos'));
})->name('home');

// ✅ User Registration Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

// ✅ User Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

// ✅ User Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ✅ Video Listing Route
Route::get('/video', function () {
    $videos = Video::all();
    return view('video', compact('videos')); // Corrected to videos.index
})->name('videos.index');

// ✅ Video Detail Route
Route::get('/video/{id}', function ($id) {
    $video = DB::table('videos')->where('VidID', $id)->first();
    if (!$video) {
        abort(404);
    }
    return view('video', ['video' => $video]); // Correct view reference
})->name('video.show'); // Changed to video.show for clarity


Route::get('/search', [VideoController::class, 'search'])->name('videos.search');
