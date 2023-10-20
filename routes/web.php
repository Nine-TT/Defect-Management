<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectControllers;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});
