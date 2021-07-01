<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchChallengeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
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
Route::get('/public/products', [PublicController::class, 'products'])->name('public_products');
Route::get('/public/about', [PublicController::class, 'about'])->name('public_about');
Route::get('/public/product/{product:name}', [PublicController::class, 'singleProduct'])->name('public_single_product');
Route::get('/public/matches/', [PublicController::class, 'matches'])->name('public_matches');
Route::get('/public/clubs/', [PublicController::class, 'clubs'])->name('public_clubs');
Route::get('/public/players/', [PublicController::class, 'players'])->name('public_players');
Route::get('/public/tournaments/', [PublicController::class, 'tournaments'])->name('public_tournaments');
Route::get('/public/players/{player}', [PublicController::class, 'singlePlayer'])->name('public_single_player');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'index'])->name('logout');

Route::get('user/profile', [UserController::class, 'profile'])->name('user_profile');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('/clubs', [ClubController::class, 'index'])->name('clubs');

Route::post('/clubs/add', [ClubController::class, 'store'])->name('add_club');
Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])->name('destroy_club');


Route::post('/clubs/{club}/add_team', [TeamController::class, 'store'])->name('add_team');

Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('destroy_team');


Route::post('/clubs/add_player', [PlayerController::class, 'store'])->name('add_player');
Route::post('/clubs/add_club_player', [PlayerController::class, 'addClub'])->name('add_club_player');

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

Route::post('/get_team_players', [TeamController::class, 'getPlayers'])->name('get_players');

Route::post('/players/get_club_players', [ClubController::class, 'getPlayers'])->name('get_club_players');

Route::post('/get_club_teams', [ClubController::class, 'getTeams'])->name('get_teams');


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

Route::get('/users/', [UserController::class, 'index' ])->name('users');
Route::delete('/users/{user}', [UserController::class, 'destroy' ])->name('destroy_user');

Route::post('/users/{user}/update_profile', [UserController::class, 'updateProfile' ])->name('update_user_profile');
Route::post('/users/{user}/update_password', [UserController::class, 'updatePassword' ])->name('update_user_password');

Route::get('/users/add_user', [UserController::class, 'addUser' ])->name('add_user');
Route::post('/users/add_user', [UserController::class, 'saveUser' ]);

Route::get('/tournaments', [TournamentController::class, 'index' ])->name('tournaments');
Route::post('/tournaments/add_tournament', [TournamentController::class, 'store' ])->name('add_tournament');
Route::post('/tournaments/{tournament}/add_club', [TournamentController::class, 'addClub' ])->name('add_tournament_club');

Route::delete('/tournaments/{tournament}/remove_club', [TournamentController::class, 'removeClub' ])->name('remove_tournament_club');
Route::delete('/tournaments/{tournament}/remove_team', [TournamentController::class, 'removeTeam' ])->name('remove_tournament_team');
Route::delete('/tournaments/{tournament}/destroy_tournament', [TournamentController::class, 'destroy' ])->name('destroy_tournament');


Route::get('/player/challenge_requests', [MatchChallengeController::class, 'index'])->name('challenge_requests');
Route::post('/player/save_challenge_request', [MatchChallengeController::class, 'store'])->name('save_challenge_request');
Route::post('/player/accept_challenge/', [MatchChallengeController::class, 'acceptChallenge'])->name('accept_challenge');
Route::post('/player/reject_challenge/', [MatchChallengeController::class, 'rejectChallenge'])->name('reject_challenge');
Route::delete('/player/destroy_challenge/', [MatchChallengeController::class, 'destroy'])->name('destroy_challenge');


Route::get('public/news/{news}', [PublicController::class, 'singleNews'])->name('single_news');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::post('/news/save', [NewsController::class, 'store'])->name('save_news');
Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('destroy_news');
