<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetweetController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [TweetController::class, 'index'])->name('tweets.index');
Route::post('/dashboard', [TweetController::class, 'store'])->name('tweets.store');

Route::post('/dashboard/tweets/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/like/{id}', [LikeController::class, 'like'])->name('like');
Route::post('/retweets', [RetweetController::class, 'store'])->name('retweets.store');

// Route::get('dashboard/explore', function() {
//         return view('explore');
//     }
// );

require __DIR__ . '/auth.php';
