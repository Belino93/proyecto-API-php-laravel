<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'genre' => 'required|string',
                'developed' => 'required|string',
            ]);
     
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }
            $title = $request->input('title');
            $genre = $request->input('genre');
            $developed = $request->input('developed');
            $user_id = auth()->user()->id;

            $titleExist = Game::where('title', $title)->first();

            if ($titleExist) {
                return response([
                    'success' => true,
                    'message' => 'This game already exist'
                ]);
            }

            Game::create([
                'title' => $title,
                'genre' => $genre,
                'developed' => $developed,
                'user_id' => $user_id
            ]);

            return response([
                'success' => true,
                'message' => 'Game created successfully',
                'data' => 'The game ' . $title . ' was created'
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
            $validator = Validator::make($request->all(), [
                'id'=>'required|integer',
                'title' => 'required|max:255|string',
                'genre' => 'required|string',
                'developed' => 'required|string',
            ]);
     
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }
            $id = $request->input('id');
            $title = $request->input('title');
            $genre = $request->input('genre');
            $developed = $request->input('developed');
            $titleExist = Game::where('title', $title)->first();

            if ($titleExist) {
                return response([
                    'success' => true,
                    'message' => 'This game already exist'
                ]);
            }
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
                'message' => 'Game updated successfully',
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

    // Delete game WHERE id = id
    public function deleteGame(Request $request)
    {
        Log::info('Delete game');
        
        try {
            $id = $request -> input('id');
            $deleted = DB::table('games') -> where('id','=', $id)->delete();

            return response([
                'success' => true,
                'message' => 'Game deleted successfully',
                'data' => $deleted
            ]);

        } catch (\Throwable $th) {
            Log::error($th -> getMessage());
            return response([
                'success' => false,
                'message' => 'Fail drop game',
            ], 400);
        }
    }
}
