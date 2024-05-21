<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
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
    Route::get('/settings', [AuthManager::class, "settings"])->name('settings');
    Route::post('/settings', [AuthManager::class, "update"])->name('settings.post');

    // Delete Post
    Route::get('/delete', [PostController::class, "delete"])->name('delete');


    // Logout/signin Page
    Route::get('/signin', [AuthManager::class, 'signin'])->name('signin');
    Route::post('/signin', [AuthManager::class, 'signinPost'])->name('signin.post');
    
    Route::get('/logout', function(){
        return redirect()->route('signin');
    });
    
    Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

    // forgetPassword
    Route::get('/forgot-password', function () {
        return view('forgotPassword');
    })->name('forgot-password');

    
    // profile
    Route::get('/user/{user_name}', [AuthManager::class, "profile"])->name('profile');

    // chat
    Route::get('/chat', [ChatController::class, "index"])->name('chat');
    Route::get('/chat/{query}', [ChatController::class, "show"])->name('user.chat');

    Route::post('/chat', [ChatController::class, "makaConversation"])->name('conversation');

});

