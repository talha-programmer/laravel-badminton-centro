<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clubs', [ApiController::class, 'clubs']);
Route::get('/clubs/{club}', [ApiController::class, 'singleClub']);

Route::get('/players', [ApiController::class, 'players']);
Route::get('/players/{player}', [ApiController::class, 'singlePlayer']);

Route::get('/matches', [ApiController::class, 'matches']);
Route::get('/matches/{match}', [ApiController::class, 'singleMatch']);

Route::get('/tournaments', [ApiController::class, 'tournaments']);
Route::get('/tournaments/{tournament}', [ApiController::class, 'singleTournament']);

Route::get('/news', [ApiController::class, 'news']);
Route::get('/news/{news}', [ApiController::class, 'singleNews']);
