<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
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
            Log::error($th -> getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve games fails',
            ], 400);
        }
    }

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
            Log::error($th -> getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve games by genre fails'
            ], 400);
        }
    }
}
