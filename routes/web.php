<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
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
Route::get('/', [PublicController::class, 'home']);
Route::get('/home', [PublicController::class, 'home'])->name('home');

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

Route::post('/product_categories/add', [ProductCategoryController::class, 'store'])->name('add_product_category');

Route::delete('/product_categories/{productCategory}/delete', [ProductCategoryController::class, 'destroy'])->name('destroy_category');


Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('destroy_product');
Route::delete('/products/{product}/image', [ProductController::class, 'destroyImage'])->name('destroy_product_image');


Route::get('/matches', [MatchController::class, 'index'])->name('matches');

Route::post('/matches/add', [MatchController::class, 'store'])->name('add_match');

Route::delete('/matches/{match}', [MatchController::class, 'destroy'])->name('destroy_match');

Route::post('/matches/{match}/add_result', [MatchController::class, 'addResult'])->name('add_match_result');

Route::post('/get_team_players', [MatchController::class, 'getPlayers'])->name('get_players');


Route::post('/cart/add_product/', [CartController::class, 'addProduct' ])->name('add_to_cart');
Route::post('/cart/delete_product/', [CartController::class, 'deleteProduct' ])->name('delete_from_cart');
Route::post('/cart/update_product/', [CartController::class, 'updateProduct' ])->name('update_product_quantity');

Route::get('/cart/checkout/', [CartController::class, 'checkout' ])->name('checkout');

Route::post('/order/save/', [OrderController::class, 'store' ])->name('save_order');
Route::get('/orders/', [OrderController::class, 'index' ])->name('orders');

Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('destroy_order');

Route::post('/orders/edit_order/{order}', [OrderController::class, 'editOrder' ])->name('edit_order');

Route::get('/orders/display_edit_order/{order}', [OrderController::class, 'displayEditOrder' ])->name('display_edit_order');

Route::post('/orders/update_order/{order}', [OrderController::class, 'updateOrder' ])->name('update_order');
