<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'index'])->name('logout');

Route::post('/{user:username}/profile', [UserController::class, 'profile'])->name('user_profile');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('/clubs', [ClubController::class, 'index'])->name('clubs');

Route::get('/clubs/add', [ClubController::class, 'addClub'])->name('add_club');
Route::post('/clubs/add', [ClubController::class, 'store']);

Route::get('/', [HomeController::class, 'index']);


