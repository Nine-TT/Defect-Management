<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectControllers;
use App\Http\Controllers\project\ProjectMemberController;

Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');


//------------ project route -----------
Route::get('/projects', function () {
    return view('project');
})->name('projects');
Route::get('/projects', [ProjectControllers::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectControllers::class, 'store'])->name('projects.store');
Route::get('/projects/{id}', [ProjectControllers::class, 'show'])->name('projects.show');
Route::delete('/projects/{id}', [ProjectControllers::class, 'destroy'])->name('projects.destroy');

// add member
Route::post('/handle-add-user', [ProjectMemberController::class, 'handleAddMemberToProject'])->name('handle-add-user.handleAddMemberToProject');

// -------------------------------------

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require  'auth.php';
