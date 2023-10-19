<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectControllers;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/projects', function () {
    return view('project');
});

// // routes/web.php
Route::get('/projects', [ProjectControllers::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectControllers::class, 'store'])->name('projects.store');
Route::get('/projects/{id}', [ProjectControllers::class, 'show'])->name('projects.show');
