<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\{UserController,DashboardController,ProjectController,TaskController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/', [LoginController::class, 'postLogin'])->name('postLogin');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/logout', [DashboardController::class, 'logout'])->name('logout'); 

    Route::get('/admin/users', [UserController::class, 'index'])->name('users');
    Route::get('/admin/users/manage', [UserController::class, 'manage'])->name('user.manage');
    Route::get('/admin/users/manage/{id}', [UserController::class, 'manage'])->name('user.manage');
    Route::post('/admin/users/process', [UserController::class, 'process'])->name('user.process');
    Route::delete('/admin/users/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/admin/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/admin/projects/manage', [ProjectController::class, 'manage'])->name('project.manage');
    Route::get('/admin/projects/manage/{id}', [ProjectController::class, 'manage'])->name('project.manage');
    Route::post('/admin/projects/process', [ProjectController::class, 'process'])->name('project.process');
    Route::delete('/admin/projects/destroy/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    Route::get('/admin/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/admin/tasks/manage', [TaskController::class, 'manage'])->name('task.manage');
    Route::get('/admin/tasks/manage/{id}', [TaskController::class, 'manage'])->name('task.manage');
    Route::post('/admin/tasks/process', [TaskController::class, 'process'])->name('task.process');
    Route::delete('/admin/tasks/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('/admin/tasks/updatePriority', [TaskController::class, 'updatePriority'])->name('task.updatePriority');
});