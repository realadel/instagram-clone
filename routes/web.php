<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/explore', [PostController::class, 'explore'])->name('explore');

// User Profile Routes
Route::get('/{user:username}', [UserController::class, 'index'])->middleware('auth')->name('user.profile');
Route::get('/{user:username}/edit', [UserController::class, 'edit'])->middleware('auth')->name('edit.profile');
Route::patch('/{user:username}/update', [UserController::class, 'update'])->middleware('auth')->name('update.profile');

// Post Controller Routes
Route::controller(PostController::class)->middleware('auth')->group(function (){
    Route::get('/', 'index')->name('home');
    Route::get('/p/create', 'create')->name('post.create');
    Route::post('/p/create', 'store')->name('post.store');
    Route::get('/p/{post:slug}', 'show')->name('post.show');
    Route::get('/p/{post:slug}/edit', 'edit')->name('post.edit');
    Route::patch('/p/{post:slug}/edit', 'update')->name('post.update');
    Route::delete('/p/{post:slug}/delete', 'destroy')->name('post.destroy');
});

// Add Comment Route
Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

// Like Posts Controller
Route::get('/p/{post:slug}/like', likeController::class)->middleware('auth')->name('like.post');

// Follow a User Controller
Route::post('{user:username}/follow', [UserController::class, 'follow'])->middleware('auth')->name('follow.user');
Route::post('{user:username}/unfollow', [UserController::class, 'unfollow'])->middleware('auth')->name('unfollow.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



