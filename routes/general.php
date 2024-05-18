<?php

use Illuminate\Support\Facades\Route;

// general
Route::get('/', function () {
    return view('general/index');
})->name('index');

Route::get('/contacts', ['as' => 'contacts', 'uses' => function () {
    return view('general/contacts');
}]);

Route::get('/gallery', function () {
    return view('general/gallery');
})->name('gallery');