<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartiesUserController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// JWT middleware
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::patch('/updateName', [UserController::class, 'updateUser']);
});

//------------Game endpoints------------

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/games', [GameController::class, 'getGames']);

    Route::get('/games/{genre}', [GameController::class, 'getGamesByGenre']);

    Route::post('/newGame', [GameController::class, 'newGame']);

    Route::patch('/updateGame', [GameController::class, 'updateGame']);

    Route::delete('/deleteGame', [GameController::class, 'deleteGame']);
});

//------------Parties users endpoints------------

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/parties/join', [PartiesUserController::class, 'joinParty']);
});

//------------Party endpoints------------

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/parties', [PartyController::class, 'getParties']);
    Route::get('/parties/user', [PartyController::class, 'getUserParties']);
    Route::post('/parties/new', [PartyController::class, 'newParty']);
    Route::get('/parties/game/{game_id}', [PartyController::class, 'getGameParties']);
    Route::delete('/parties/{game_id}', [PartyController::class, 'deleteParty']);
});

//------------Message endpoints------------
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/messages', [MessageController::class, 'getMessageById']);
    Route::post('/messages', [MessageController::class, 'newMessage']);
    Route::put('/messages', [MessageController::class, 'editMessage']);
    Route::delete('/messages', [MessageController::class, 'deleteMessage']);
    Route::post('/partyChat', [MessageController::class, 'getChat']);

});
