<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// general
Route::get('/', function () {
    return view('general/index');
});

Route::get('/contacts', ['as' => 'contacts', 'uses' => function () {
    return view('general/contacts');
}]);

Route::get('/gallery', function () {
    return view('general/gallery');
})->name('gallery');


// authentication
Route::middleware('guest')->group(function() {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'authenticate']);
        Route::get('/login', ['as' => 'login', 'uses' => function () {
            return view('auth/login');
        }]);
    
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/register', function () {
            return view('auth/register');
        })->name('register');
    });
});

// authenticated user
Route::get('/dashboard', function () {
    return view('user/dashboard');
})->name('dashboard')->middleware('auth');;