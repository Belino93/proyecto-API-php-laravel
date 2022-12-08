<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    // SELECT * FROM games
    public function getGames()
    {
        Log::info('Getting all games');

        try {
            $games = DB::table('games')->get();
            return response([
                'success' => true,
                'message' => 'All games retrieves successfully',
                'data' => $games,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve games fails',
            ], 400);
        }
    }

    // SELECT * FROM games WHERE genre=genre
    public function getGamesByGenre($genre)
    {
        try {

            Log::info('Getting games by genre');
            $games = DB::table('games')
                ->where('genre', '=', $genre)
                ->get();
            return response([
                'success' => true,
                'message' => 'All games by genre retrieved',
                'data' => $games,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve games by genre fails'
            ], 400);
        }
    }

    // Create new game
    public function newGame(Request $request)
    {
        Log::info('Creating new game');

        $title = $request->input('title');
        $genre = $request->input('genre');
        $developed = $request->input('developed');
        try {
            $newGame = DB::table('games')->insertGetId(
                [
                    'title' => $title,
                    'genre' => $genre,
                    'developed' => $developed,
                ]
            );

            return response([
                'success' => true,
                'message' => 'Game created successfully',
                'data' => 'The game ' . $title . ' was created with id ' . $newGame,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'New game was failed',
            ], 400);
        }
    }

    // Update game
    public function updateGame(Request $request)
    {
        Log::info('Updating game');

        try {
            $id = $request->input('id');
            $title = $request->input('title');
            $genre = $request->input('genre');
            $developed = $request->input('developed');
            $updated = DB::table('games')
                ->where('id', $id)
                ->update(
                    [
                        'title' => $title,
                        'genre' => $genre,
                        'developed' => $developed,
                    ]
                );
            return response([
                'success' => true,
                'message' => 'All tasks retrieved successfully',
                'data' => $updated
            ], 200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Fail in patch game',
            ], 400);
        }
    }
}
