<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\PostController;

// SignUp
Route::get('/signup', [AuthManager::class, 'signup'])->name('signup');
Route::post('/signup', [AuthManager::class, 'signupPost'])->name('signup.post');

Route::middleware(['web', 'throttle:600,1'])->group(function () {

    // follow
    Route::post('/follow/{id}', [AuthManager::class, 'follow'])->name('follow');

    // Add / Edit Post
    Route::get('/post', [PostController::class, "postRoute"])->name('post');
    Route::post('/post', [PostController::class, "create"])->name('post.store'); // Store route
    Route::post('/post/update', [PostController::class, "update"])->name('post.update'); // Update route

    // Home page
    Route::get('/', [PostController::class, "home"])->name('home');

    // Edit User
    Route::get('/setting', [AuthManager::class, "setting"])->name('settings');
    Route::post('/setting', [AuthManager::class, "settingPost"])->name('settings.post');

    // Delete Post
    Route::get('/delete', [PostController::class, "delete"])->name('delete');


    // Like Post
    Route::post('/Like/{id}', [PostController::class, 'like'])->name('like');

    // Logout/Login Page
    Route::get('/login', [AuthManager::class, 'login'])->name('login');
    Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
    
    Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

    
    // profile
    Route::get('/user/{user_name}', [AuthManager::class, "profile"])->name('profile');

});

