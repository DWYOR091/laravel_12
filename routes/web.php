<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::get('/tambah', [BlogController::class, 'create'])->name('blog.tambah');
    Route::post('/simpan', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/update/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/detail/{blog}', [BlogController::class, 'show'])->name('blog.show');
});
