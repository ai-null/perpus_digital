<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/general.php';

// authenticated user
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return view('user/dashboard');
    })->name('dashboard');
});

Route::prefix('book')->group(function() {
    Route::get('/detail', function () {
        return view('book/detail');
    })->name('borrow_book');
});