<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PartiesUserController extends Controller
{
    public function joinParty(Request $request) 
    {
        Log::info('Join in Party');

        try {
            $validator = Validator::make($request->all(), [
                'party_id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $parties = DB::table('parties_users')
                        ->where('party_id', '=', $request->get('party_id'))
                        ->where('user_id', '=', auth()-> user()->id)
                        ->get();

            if (count($parties) === 0) {
                DB::table('parties_users')->insert([
                    'user_id' => auth()->user()->id,
                    'party_id' => $request -> get('party_id')
                ]);
                return response([
                    'success' => true,
                    'message' => 'Joined in party',
                ], 200);
            }
            
        } catch (\Throwable $th) {
            Log::error('Error joining in party');
            return response()->json([
                'success' => false,
                'message' => 'Party not exist'
            ], 400);
        }
    }
}
