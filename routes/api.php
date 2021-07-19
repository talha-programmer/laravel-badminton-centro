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

Route::post('/clubs', [ApiController::class, 'clubs']);
Route::post('/clubs/{club}', [ApiController::class, 'singleClub']);

Route::post('/players', [ApiController::class, 'players']);
Route::post('/players/{player}', [ApiController::class, 'singlePlayer']);

Route::post('/matches', [ApiController::class, 'matches']);
Route::post('/matches/{match}', [ApiController::class, 'singleMatch']);

Route::post('/tournaments', [ApiController::class, 'tournaments']);
Route::post('/tournaments/{tournament}', [ApiController::class, 'singleTournament']);
