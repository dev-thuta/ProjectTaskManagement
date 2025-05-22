<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
