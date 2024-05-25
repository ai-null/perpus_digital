<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/general.php';

// authenticated user
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        return view('user/dashboard');
    })->name('dashboard');
});


// Route::get('/user/{id}', function (Request $request, string $id) {
//     return 'User '.$id;
// });
Route::prefix('book')->group(function() {
    Route::get('/detail', function () {
        return view('book/detail');
    })->name('borrow_book');
});