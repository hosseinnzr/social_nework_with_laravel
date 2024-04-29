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

    // Home page
    Route::get('/', [PostController::class, "home"])->name('home');

    // Edit User
    Route::get('/setting/{user}', [AuthManager::class, "setting"])->name('settings');
    Route::post('/setting/{user}', [AuthManager::class, "settingPost"])->name('settings.post');

    // Edit Post
    Route::get('/edit/post/{id}', [PostController::class], )->name('postEdit');
    Route::post('/edit/post/{id}', [PostController::class], )->name('postEdit.post');

    // Delete Post
    Route::post('/delete/{id}', [PostController::class, "delete"])->name('delete');

    // search Post by hashtag
    // Route::get('/search', [PostController::class, 'search'])->name('search');

    // Like Post
    Route::post('/Like/{id}', [PostController::class, 'like'])->name('like');

    // Add Post Page
    Route::get('/addPost', function(){
        return view('addPost');
    })->name('addPost');
    Route::post('/addPost', [PostController::class, 'create'])->name('addPost.post');

    // Logout/Login Page
    Route::get('/login', [AuthManager::class, 'profile'])->name('login');
    Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
    
    Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

    
    // profile
    Route::get('/{user_name}', [AuthManager::class, "profile"])->name('profile');

});

