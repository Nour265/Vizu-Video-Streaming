<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;use Illuminate\Support\Facades\DB;

// Home Page Route
Route::get('/', function () {
    $videos = Video::latest()->take(12)->get();
    return view('home', compact('videos'));
})->name('home');

// User Registration Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

// User Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

// User Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Video Listing Route
Route::get('/video', function () {
    $videos = Video::all();
    return view('video', compact('videos'));
})->name('video.show');

// Video Detail Route
Route::get('/video/{id}', function ($id) {
    $video = Video::where('VidID', $id)->firstOrFail();
    return view('video', ['video' => $video]);
})->name('video.show');

Route::get('/search', [VideoController::class, 'search'])->name('videos.search');


// ✅ Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/manage/users', [AdminController::class, 'manageUsers'])->name('admin.manage.users');
Route::get('/admin/manage/videos', [AdminController::class, 'manageVideos'])->name('admin.manage.videos');
