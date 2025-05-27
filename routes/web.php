<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Team_memberController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// auth
Auth::routes();

// users
Route::get('/users', [
    UserController::class,
    'index'
]);
Route::get('/users/add', [
    UserController::class,
    'add'
]);
Route::post('/users/create', [
    UserController::class,
    'create'
]);
Route::get('/users/edit/{id}', [
    UserController::class,
    'edit'
]);
Route::put('/users/update/{id}', [
    UserController::class,
    'update'
]);
Route::get('users/delete/{id}', [
    UserController::class,
    'delete'
]);

// roles
Route::get('/roles', [
    RoleController::class,
    'index'
]);
Route::get('/roles/add', [
    RoleController::class,
    'add'
]);
Route::post('/roles/create', [
    RoleController::class,
    'create'
]);
Route::get('/roles/edit/{id}', [
    RoleController::class,
    'edit'
]);
Route::put('/roles/update/{id}', [
    RoleController::class,
    'update'
]);
Route::get('roles/delete/{id}', [
    RoleController::class,
    'delete'
]);

// clients
Route::get('/clients', [
    ClientController::class,
    'index'
]);
Route::get('/clients/add', [
    ClientController::class,
    'add'
]);
Route::post('/clients/create', [
    ClientController::class,
    'create'
]);
Route::get('/clients/edit/{id}', [
    ClientController::class,
    'edit'
]);
Route::put('/clients/update/{id}', [
    ClientController::class,
    'update'
]);
Route::get('clients/delete/{id}', [
    ClientController::class,
    'delete'
]);

// states
Route::get('/states', [
    StateController::class,
    'index'
]);
Route::get('/states/add', [
    StateController::class,
    'add'
]);
Route::post('/states/create', [
    StateController::class,
    'create'
]);
Route::get('/states/edit/{id}', [
    StateController::class,
    'edit'
]);
Route::put('/states/update/{id}', [
    StateController::class,
    'update'
]);
Route::get('states/delete/{id}', [
    StateController::class,
    'delete'
]);

// towns
Route::get('/towns', [
    TownController::class,
    'index'
]);
Route::get('/towns/add', [
    TownController::class,
    'add'
]);
Route::post('/towns/create', [
    TownController::class,
    'create'
]);
Route::get('/towns/edit/{id}', [
    TownController::class,
    'edit'
]);
Route::put('/towns/update/{id}', [
    TownController::class,
    'update'
]);
Route::get('towns/delete/{id}', [
    TownController::class,
    'delete'
]);

// projects
Route::get('/projects', [
    ProjectController::class,
    'index'
]);
Route::get('/projects/add', [
    ProjectController::class,
    'add'
]);
Route::post('/projects/create', [
    ProjectController::class,
    'create'
]);
Route::get('/projects/edit/{id}', [
    ProjectController::class,
    'edit'
]);
Route::put('/projects/update/{id}', [
    ProjectController::class,
    'update'
]);
Route::get('projects/delete/{id}', [
    ProjectController::class,
    'delete'
]);

// teams
Route::get('/teams', [
    TeamController::class,
    'index'
]);
Route::get('/teams/add', [
    TeamController::class,
    'add'
]);
Route::post('/teams/create', [
    TeamController::class,
    'create'
]);
Route::get('/teams/edit/{id}', [
    TeamController::class,
    'edit'
]);
Route::put('/teams/update/{id}', [
    TeamController::class,
    'update'
]);
Route::get('teams/delete/{id}', [
    TeamController::class,
    'delete'
]);

// team members
Route::get('/team-members', [
    Team_memberController::class,
    'index'
]);
Route::get('/team-members/add', [
    Team_memberController::class,
    'add'
]);
Route::post('/team-members/create', [
    Team_memberController::class,
    'create'
]);
Route::get('/team-members/edit/{id}', [
    Team_memberController::class,
    'edit'
]);
Route::put('/team-members/update/{id}', [
    Team_memberController::class,
    'update'
]);
Route::get('team-members/delete/{id}', [
    Team_memberController::class,
    'delete'
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
