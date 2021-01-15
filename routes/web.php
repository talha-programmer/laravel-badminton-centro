<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TeamController;
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
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'index'])->name('logout');

Route::post('/{user:username}/profile', [UserController::class, 'profile'])->name('user_profile');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('/clubs', [ClubController::class, 'index'])->name('clubs');

Route::post('/clubs/add', [ClubController::class, 'store'])->name('add_club');
Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])->name('destroy_club');


Route::post('/clubs/{club}/add_team', [TeamController::class, 'store'])->name('add_team');

Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('destroy_team');


Route::post('/clubs/add_player', [PlayerController::class, 'store'])->name('add_player');
Route::delete('/clubs/{club}/{player}', [ClubController::class, 'removePlayer'])->name('remove_player_from_club');

Route::get('/players', [PlayerController::class, 'index'])->name('players');
Route::delete('/teams/{team}/{player}', [TeamController::class, 'removePlayer'])->name('remove_player_from_team');


Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/products/add', [ProductController::class, 'addProduct'])->name('add_product');
Route::post('/products/add', [ProductController::class, 'store']);


Route::get('/product_categories', [ProductCategoryController::class, 'index'])->name('product_categories');

Route::get('/product_categories/add', [ProductCategoryController::class, 'addCategory'])->name('add_product_category');
Route::post('/product_categories/add', [ProductCategoryController::class, 'store']);


Route::get('/matches', [MatchController::class, 'index'])->name('matches');

Route::get('/matches/add', [MatchController::class, 'addMatch'])->name('add_match');
Route::post('/matches/add', [MatchController::class, 'store']);

Route::delete('/matches/{match}', [MatchController::class, 'destroy'])->name('destroy_match');

Route::post('/get_team_players', [MatchController::class, 'getPlayers'])->name('get_players');