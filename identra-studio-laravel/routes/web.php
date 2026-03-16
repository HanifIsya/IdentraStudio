<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register'); // Ini akan mencari file register.blade.php
})->name('register');

Route::get('/login', function () {
    return view('login'); // Ini akan mencari file login.blade.php
})->name('login');

Route::get('/home', function () {
    return view('home'); // Ini akan mencari file home.blade.php
})->name('home');
