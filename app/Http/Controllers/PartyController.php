<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    // Get all parties
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


    // Get parties by user_id
    public function getUserParties()
    {
        Log::info('Getting user parties');

        try {
            $userId = auth()->user()->id;
            $parties = DB::table('parties_users')
                    ->join('users', 'users.id', '=', 'parties_users.user_id')
                    ->select('party_id')
                    ->where('active', '=', 1)
                    ->where('users.id', '=', $userId)
                    ->get();

            return response([
                'success' => true,
                'message' => 'All games retrieves successfully',
                'data' => $parties
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve parties fails',
            ], 400);
        }
    }

    // Get parties by game_id
    public function getGameParties($game_id)
    {
        Log::info('Getting game parties');

        try {
            $parties = DB::table('parties')
                ->where('game_id', '=', $game_id)
                ->get();
            if (count($parties) === 0) {
                return response([
                    'success' => false,
                    'message' => 'Any party in this game',
                ], 400);
            };
            return response([
                'success' => true,
                'message' => 'All games retrieves successfully',
                'data' => $parties
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error get game parties: ');
            return response()->json([
                'success' => false,
                'message' => 'Any party in this game'
            ], 400);
        }
    }

    // Create new party
    public function newParty(Request $request)
    {
        Log::info('Create new party');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'game_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        try {
            $party = Party::create([
                'name' => $request->get('name'),
                'game_id' => $request->get('game_id'),
                'owner' => auth()->user()->id,
            ]);
            //dd($party);
            $party->user()->attach(auth()->user()->id);
            
            return response([
                'success' => true,
                'message' => 'Party created successfully'
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error creating party: ' . $th->getMessage());

            return response([
                'success' => false,
                'message' => 'The game is not available',
            ], 400);
        }
    }

    public function deleteParty($id){
        Log::info('Delete party');

        try {
            $deleted = Party::find($id);

            if ($deleted->owner !== auth()->user()->id) {
                return response([
                    'success' => false,
                    'message' => 'Delete only your parties',
                ], 400);
            }
            $deleted ->delete();
            return response([
                'success' => true,
                'message' => 'Party deleted successfully',
            ]);
            
        } catch (\Throwable $th) {
            Log::error($th -> getMessage());
            return response([
                'success' => false,
                'message' => 'Drop party fail',
            ], 400);
        }


    }

}
