<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    // authentication
    Route::middleware('guest')->group(function () {
        Route::post('/login', [AuthController::class, 'authenticate']);
        Route::get('/login', ['as' => 'login', 'uses' => function () {
            return view('auth/login');
        }]);

        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/register', function () {
            return view('auth/register');
        })->name('register');
    });

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    Route::get('/logout', function () {
        abort(403);
    });
});
