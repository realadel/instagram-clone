<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

// Create Post Routes
Route::get('/p/create', [PostController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/p/create', [PostController::class, 'store'])->name('post.store')->middleware('auth');

// Show Post Route
Route::get('/p/{post:slug}', [PostController::class, 'show'])->name('post.show')->middleware('auth');

// Edit Post Routes
Route::get('/p/{post:slug}/edit', [PostController::class, 'edit'])->name('post.edit')->middleware('auth');
Route::patch('/p/{post:slug}/edit', [PostController::class, 'update'])->name('post.update')->middleware('auth');

// Delete Post Route
Route::delete('/p/{post:slug}/delete', [PostController::class, 'destroy'])->name('post.destroy')->middleware('auth');

// Comments Routes
Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

require __DIR__.'/auth.php';
