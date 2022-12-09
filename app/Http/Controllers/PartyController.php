<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartyController extends Controller
{
    public function getParties()
    {
        Log::info('Getting parties');

        try {
            $parties = DB::table('parties')->get();
            return response([
                'success' => true,
                'message' => 'All games retrieves successfully',
                'data' => $parties,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve parties fails',
            ], 400);
        }
    }
    public function getUserParties($user_id)
    {
        Log::info('Getting user parties');

        try {
            $parties = Party::find($user_id);
            return response([
                'success' => true,
                'message' => 'All games retrieves successfully',
                'data' =>$parties, $parties->user
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve parties fails',
            ], 400);
        }
    }
}
