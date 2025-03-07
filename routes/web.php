<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/video/{id}', function ($id) {
    $videos = [
        1 => ['title' => 'Sample Video 1', 'file' => 'videos/sample1.mp4'],
        2 => ['title' => 'Sample Video 2', 'file' => 'videos/sample2.mp4']
    ];

    if (!isset($videos[$id])) {
        abort(404);
    }

    return view('video', ['video' => $videos[$id]]);
})->name('video.show');



require __DIR__.'/auth.php';
