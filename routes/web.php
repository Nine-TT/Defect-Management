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
        Route::get('/projects/{projectID}/users', [ProjectMemberController::class, 'index'])->name('projects.member');
        Route::delete('/projects/{projectID}/users', [ProjectMemberController::class, 'deleteUser'])->name('handelDeleteUser.projectMember');
        Route::patch('/projects/{projectID}/users', [ProjectMemberController::class, 'handleChangeRole'])->name('handleChangeRole.projectMember');
        Route::post('/projects/{projectID}/craeate-test-type', [ProjectControllers::class, 'handleCreateTestType'])->name('handleCreateTestType.projects');
        Route::post('/projects/{projectID}/craeate-error-type', [ProjectControllers::class, 'handleCreateErrorType'])->name('handleCreateErrorType.projects');
        Route::put('/projects/{projectID}/change-info', [ProjectControllers::class, 'handleChangeProjectInfo'])->name('handleChangeProjectInfo.projects');
        Route::delete('/projects/{projectID}/delete-test-type', [ProjectControllers::class, 'deleteTestType'])->name('deleteTestType.projectMember');
        Route::delete('/projects/{projectID}/delete-error-type', [ProjectControllers::class, 'deleteErrorType'])->name('deleteErrorType.projectMember');
    });
});

//-----------------Errors route-----------------------
Route::middleware(['auth', 'checkProjectMembership'])->group(function () {
    route::get('/projects/{projectID}/errors', [ErrorController::class, 'index'])->name('error.index');
    route::post('/projects/{projectID}/errors', [ErrorController::class, 'store'])->name('error.store');
    route::patch('/projects/{projectID}/errors', [ErrorController::class, 'update'])->name('error.update');
    route::post('/projects/{projectID}/errors/comment', [ErrorController::class, 'sendComment'])->name('error.sendComment');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/task', [ErrorController::class, 'taskIndex'])->name('task.index')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require 'auth.php';
