<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\PostController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


// SignUp
Route::get('/signup', [AuthManager::class, 'signup'])->name('signup');
Route::post('/signup', [AuthManager::class, 'signupPost'])->name('signup.post');

Route::middleware(['web', 'throttle:60,1'])->group(function () {

    // explore
    Route::get('/explore', [PostController::class, 'explore'])->name('explore');

    // Home page
    Route::get('/', [AuthManager::class, "login"])->name('Dashboard');

    // Edit User
    Route::get('/edit/{user}', [AuthManager::class, "update"])->name('edit');
    Route::post('/edit/{user}', [AuthManager::class, "updateUser"])->name('edit.post');

    // Edit Post
    Route::get('/edit/post/{id}', [PostController::class], )->name('postEdit');
    Route::get('/edit/post/{id}', [PostController::class], )->name('postEdit.post');

    //delete
    Route::post('/delete/{id}', [PostController::class, "delete"])->name('delete');

    // Add Post Page
    Route::get('/addPost', function(){
        return view('addPost');
    })->name('addPost');
    Route::post('/addPost', [PostController::class, 'create'])->name('addPost.post');

    // Login Page
    Route::get('/login', [AuthManager::class, 'login'])->name('login');
    Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

    // LogOut
    Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
    Route::group(['middleware' => 'auth'], function (){
        Route::get('/profile', function () {
            return 'hi';
        });
    });
});

