<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/home', [MainController::class, 'home'])->name('home');
Route::post('/addTask', [MainController::class, 'addTask']);
Route::post('/changeTask', [MainController::class, 'changeTask']);

//Auth::routes();
//Route::get('/admin', [AuthenticationController::class, 'auth'])->name('auth');
//Route::post('/admin/checkUser', [AuthenticationController::class, 'checkUser']);

Auth::routes();

Route::get('/admin', [AuthenticationController::class, 'auth'])->name('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');