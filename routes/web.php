<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ClientController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
