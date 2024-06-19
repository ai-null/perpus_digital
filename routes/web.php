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

    Route::get('/listBook', [AdminController::class, 'showListBookPage'])->name('listBook');
    Route::post('/listBook/delete', [AdminController::class, 'deleteBook'])->name('book.delete');
    Route::get('/listBook/delete', function () {
        return redirect()->route('listBook');
    })->name('book.delete');
});


// Route::get('/user/{id}', function (Request $request, string $id) {
//     return 'User '.$id;
// });
Route::prefix('book')->group(function() {
    Route::get('/detail/{id}', [DashboardController::class, 'showDetail'])->name('borrow_book');
});