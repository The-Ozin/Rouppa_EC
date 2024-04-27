<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/user-register', function () {
    return view('user.user-register');
});


