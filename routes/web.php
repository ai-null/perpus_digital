<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('general/index');
});

Route::get('/contacts', ['as' => 'contacts', 'uses' => function () {
    return view('general/contacts');
}]);

Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::get('/gallery', function () {
    return view('general/gallery');
})->name('gallery');


// authentication
Route::prefix('auth')->group(function () {
    Route::get('/login', ['as' => 'login', 'uses' => function () {
        return view('auth/login');
    }]);

    Route::get('/register', function () {
        return view('auth/register');
    })->name('register');
});

// todo: add dashboard with login middleware