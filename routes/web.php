<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Jobs\ProcessMail;
use App\Mail\CobaMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

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

    Route::get('/image', [ImageController::class, 'index'])->name('image.index')->middleware('tokenValid');
    Route::get('/rating', [RatingController::class, 'index'])->name('rating.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    //login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.auth');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/createNewUser', [AuthController::class, 'createNewUser'])->name('createNewUser');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/blog');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//mail
Route::get('/mailtesting', function () {
    $users = [
        [
            'email' => 'aaa@gmail.com',
            'name' => 'aaa',
        ],
        [
            'email' => 'bbb@gmail.com',
            'name' => 'bbb',
        ],
        [
            'email' => 'ccc@gmail.com',
            'name' => 'ccc',
        ],
        [
            'email' => 'ddd@gmail.com',
            'name' => 'ddd',
        ],
        [
            'email' => 'eee@gmail.com',
            'name' => 'eee',
        ],

    ];
    foreach ($users as $key => $user) {
        ProcessMail::dispatch($user)->onQueue('kirim-mail');
    }
    return 'email terkirim!!';
});
