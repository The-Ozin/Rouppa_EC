<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/user-register', function () {
    return view('user.user-register');
});

Route::get('/profile-settings', function () {
    return view('user.profile-settings');
});


