<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function() {
    return 'login';
});

Route::get('/register', function() {
    return 'register';
});

Route::get('/contacts', function() {
    return view('contacts');
});