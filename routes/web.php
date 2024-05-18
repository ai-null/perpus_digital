<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/general.php';

// authenticated user
Route::get('/dashboard', function () {
    return view('user/dashboard');
})->name('dashboard')->middleware('auth');;