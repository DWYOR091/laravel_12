<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function () {

    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('/tambah', [BlogController::class, 'create'])->name('blog.tambah');
        Route::post('/simpan', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/update/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::get('/detail/{blog}', [BlogController::class, 'show'])->name('blog.show');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
    });

    // Route::post('/phone', [CommentController::class, 'store']);
    Route::post('/comment/{blog_id}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');

    Route::get('/image', [ImageController::class, 'index'])->name('image.index');
    Route::get('/rating', [RatingController::class, 'index'])->name('rating.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    //login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.auth');
});