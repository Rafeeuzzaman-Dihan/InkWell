<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Admin Routes
Route::middleware(['auth', 'check.admin'])->prefix('admin')->group(function () {
    // User Management Routes
    Route::get('user', [UserController::class, 'index'])->name('users.index');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Admin Post Management Routes
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});


// Author Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    // Category Management
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    // Author Post Management Routes
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Route::middleware('check.post.author')->group(function (){
    //     Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    //     Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    //     Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    // });

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
});
