<?php

use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\RunClassInSeparateProcess;
use Symfony\Component\Routing\Router;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/identra', function () {
    return view('Identra.index', ["greeting" => "hello"]);
});
