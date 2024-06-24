<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsMember;
use App\Http\Middleware\EnsureIsAuthenticated;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/general.php';

// Route::prefix('api')->group(function() {
//     Route::get('/category', [AdminController::class, 'showCategoryApi'])->name('category.api');
// });

// Admin & Member
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware([EnsureIsAuthenticated::class])->name('dashboard');

// admin
Route::middleware([EnsureIsAdmin::class])->group(function () {
    // forced to use indonesian for path, since it's the most 'sound' ones
    Route::get('/peminjaman', [AdminController::class, 'showPeminjamanPage'])->name('peminjaman');

    Route::get('/category', [AdminController::class, 'showCategoryPage'])->name('category');
    Route::post('/category', [AdminController::class, 'addCategory'])->name('category');
    Route::post('/category/delete', [AdminController::class, 'deleteCategory'])->name('category.delete');
    Route::get('/category/delete', function () {
        return redirect()->route('category');
    })->name('category.delete');

    Route::get('/addBook', [AdminController::class, 'showAddBookPage'])->name('book.add');
    Route::post('/addBook', [AdminController::class, 'addBook']);

    Route::get('/editBook/{id}', [AdminController::class, 'showEditBookPage'])->name('book.edit');
    Route::post('/editBook/{id}', [AdminController::class, 'editBook']);

    Route::get('/listBook', [AdminController::class, 'showListBookPage'])->name('book.list');

    Route::post('/listBook/delete', [AdminController::class, 'deleteBook'])->name('book.delete');
    Route::get('/listBook/delete', function () {
        return redirect()->route('book.list');
    })->name('book.delete');
});

// Member
Route::prefix('book')->middleware([EnsureIsMember::class])->group(function () {
    Route::get('/detail/{id}', [DashboardController::class, 'showDetail'])->name('book.detail');
    Route::post('/borrow/{id}', [DashboardController::class, 'borrow'])->name('book.borrow');
});
