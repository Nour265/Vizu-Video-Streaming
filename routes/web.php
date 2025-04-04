<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentRateController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;


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
    $video = Video::findOrFail($id);

    $channel = $video->channel;

    $channelId = $channel->CID;


    $name = $channel->name;

    $recommended = Video::where('VidID', '!=', $id)
                        ->inRandomOrder()
                        ->take(10)
                        ->get();

    $isSubscribed = false;
    if (Auth::check()) {
        $isSubscribed = Subscription::where('UID', Auth::id())
                                    ->where('CID', $channelId)
                                    ->exists();
    }
    return view('video', compact('video', 'recommended', 'channelId', 'isSubscribed', 'name')); // Pass both the video and recommended videos
})->name('video.show');

Route::get('/search', [VideoController::class, 'search'])->name('videos.search');


// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/manage/users', [AdminController::class, 'manageUsers'])->name('admin.manage.users');
Route::get('/admin/manage/videos', [AdminController::class, 'manageVideos'])->name('admin.manage.videos');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
Route::get('/admin/manage-users/search', [AdminController::class, 'searchUsers'])->name('admin.manage.users.search');
Route::get('/admin/manage-videos/search', [AdminController::class, 'searchVid'])->name('admin.manage.videos.search');
Route::get('/admin/videos/{VidID}/edit', [AdminController::class, 'editVideo'])->name('admin.videos.edit');
Route::put('/admin/videos/{VidID}', [AdminController::class, 'updateVideo'])->name('admin.videos.update');
Route::delete('/admin/videos/{VidID}', [AdminController::class, 'destroy'])->name('admin.videos.destroy');

// Contact Us Routes
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'sendContactEmail'])->name('contact.send');

// Profile Routes
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', function () {
    return view('about');
})->name('about');


// Comment rating routes
Route::post('/video/{videoId}/comment', [CommentRateController::class, 'store'])->name('comment.store');
Route::get('/video/{videoId}/comments', [CommentRateController::class, 'show'])->name('comments.show');
Route::delete('/comment/{commentId}', [CommentRateController::class, 'destroy'])->name('comment.destroy');


// Subscribe route
Route::post('/subscribe/{creatorId}', [SubscriptionController::class, 'subscribe'])
    ->middleware('auth') // Ensures only logged-in users can subscribe
    ->name('subscribe');
