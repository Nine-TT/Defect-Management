<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Error\ErrorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\project\ProjectControllers;
use App\Http\Controllers\project\ProjectMemberController;

Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');


//------------ project route -----------
Route::middleware('auth')->group(function () {
    Route::get('/projects', [ProjectControllers::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectControllers::class, 'store'])->name('projects.store');
    // add member
    Route::post('/handle-add-user', [ProjectMemberController::class, 'handleAddMemberToProject'])->name('handle-add-user.handleAddMemberToProject');
    // ------------------------------------


    Route::middleware('checkProjectMembership')->group(function () {
        Route::get('/projects/{projectID}', [ProjectControllers::class, 'show'])->name('projects.show');
        Route::delete('/projects/{projectID}', [ProjectControllers::class, 'destroy'])->name('projects.destroy');
        Route::get('/projects/{projectID}/users', [ProjectMemberController::class, 'managementUserInProject'])->name('projects.member');
    });
});

//-----------------Errors route-----------------------
Route::middleware(['auth','checkProjectMembership'])->group(function () {
    route::get('/projects/{projectID}/errors',[ErrorController::class,'index'])->name('error.index');
    route::post('/projects/{projectID}/errors',[ErrorController::class,'store'])->name('error.store');
    route::patch('/projects/{projectID}/errors',[ErrorController::class,'update'])->name('error.update');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require 'auth.php';
