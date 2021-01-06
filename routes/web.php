<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
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

Route::get('/clubs/add', [ClubController::class, 'addClub'])->name('add_club');
Route::post('/clubs/add', [ClubController::class, 'store']);


Route::get('/clubs/{club}/add_team', [TeamController::class, 'addTeam'])->name('add_team');
Route::post('/clubs/{club}/add_team', [TeamController::class, 'store']);

Route::get('/clubs/{club}/add_team', [TeamController::class, 'addTeam'])->name('add_team');
Route::post('/clubs/{club}/add_team', [TeamController::class, 'store']);

Route::get('/clubs/{club}/add_player',function ($club){
    session()->remove('selected_team');
    session()->put('selected_club' , $club);
    return (new PlayerController)->addPlayer();
})->name('add_player_in_club');

Route::get('/clubs/team/{team}/add_player',function ($team){
    session()->remove('selected_club');
    session()->put('selected_team' , $team);
    return (new PlayerController)->addPlayer();
})->name('add_player_in_team');

Route::post('/clubs/add_player', [PlayerController::class, 'store'])->name('add_player');

Route::get('/players', [PlayerController::class, 'index'])->name('players');


Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/products/add', [ProductController::class, 'addProduct'])->name('add_product');
Route::post('/products/add', [ProductController::class, 'store']);


Route::get('/product_categories', [ProductCategoryController::class, 'index'])->name('product_categories');

Route::get('/product_categories/add', [ProductCategoryController::class, 'addCategory'])->name('add_product_category');
Route::post('/product_categories/add', [ProductCategoryController::class, 'store']);
