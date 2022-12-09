<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PartyController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//------------Game endpoints------------
Route::get('/games', [GameController::class, 'getGames']);

Route::get('/games/{genre}', [GameController::class, 'getGamesByGenre']);

Route::post('/newGame', [GameController::class, 'newGame']);

Route::patch('/updateGame', [GameController::class, 'updateGame']);

Route::delete('/deleteGame', [GameController::class, 'deleteGame']);

//------------Party endpoints------------
Route::get('/parties', [PartyController::class, 'getParties']);
Route::get('/parties/{user_id}', [PartyController::class, 'getUserParties']);
