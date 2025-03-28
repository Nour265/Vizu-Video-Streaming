<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

// Home Page Route
Route::get('/', function () {
    $videos = Video::latest()->take(12)->get();
    return view('home', compact('videos'));
})->name('home');

require __DIR__.'/auth.php';

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
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
Route::get('/admin/manage-users/search', [AdminController::class, 'searchUsers'])->name('admin.manage.users.search');
Route::get('/admin/manage-videos/search', [AdminController::class, 'searchVideos'])->name('admin.manage.videos.search');


// ✅ Contact Us Routes
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'sendContactEmail'])->name('contact.send');


Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

