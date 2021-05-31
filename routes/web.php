<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/update-avatar', [ProfileController::class, 'update_avatar'])->name('update_avatar');
Route::post('/change-password', [ProfileController::class, 'change_password'])->name('change_password');

//Users
Route::resource('users', UserController::class)->middleware('admin');

//Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index')->middleware('project.manager');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/edit/{project}', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/update/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/destroy/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('/my-projects', [ProjectController::class, 'my_projects'])->name('projects.my_projects');

//Tasks
Route::get('/tasks/{project}', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create/{project}', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store/{project}', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/update/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/destroy/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/change/{task}', [TaskController::class, 'change'])->name('tasks.change');
Route::put('/tasks/change/{task}', [TaskController::class, 'change_update'])->name('tasks.change_update');

//Leaves
Route::get('/my-leaves', [LeaveController::class, 'my_leaves'])->name('leaves.my_leaves');
Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
Route::post('/leaves/store', [LeaveController::class, 'store'])->name('leaves.store');
Route::get('/all-leaves', [LeaveController::class, 'all_leaves'])->name('leaves.all_leaves');
Route::get('/change/{leave}', [LeaveController::class, 'change_state'])->name('leaves.change_state');
Route::delete('/leaves/destroy/{leave}', [LeaveController::class, 'destroy'])->name('leaves.destroy');
