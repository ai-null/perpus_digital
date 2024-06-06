<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/general.php';

// authenticated user
Route::middleware('auth')->group(function() {

    // general
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    // admin
    // forced to use indonesian for path, since it's the most 'sound' ones
    Route::get('/peminjaman', [AdminController::class, 'showPeminjamanPage'])->name('peminjaman');
    
    Route::get('/addBook', [AdminController::class, 'showAddBookPage'])->name('addBook');
    Route::post('/addBook', [AdminController::class, 'addBook']);
});


// Route::get('/user/{id}', function (Request $request, string $id) {
//     return 'User '.$id;
// });
Route::prefix('book')->group(function() {
    Route::get('/detail', function () {
        return view('book/detail');
    })->name('borrow_book');
});