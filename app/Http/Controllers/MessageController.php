<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //Get message by id
    public function getMessageById()
    {
        Log::info('Getting user messages');

        try {
            $messages = Message::where('user_id', auth()->user()->id)->get();

            return response([
                'success' => true,
                'message' => 'Retrieve messages successfully',
                'data' => $messages
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Retrieve messages fails',
            ], 400);
        }
    }

    public function newMessage(Request $request)
    {
        Log::info('New message');

        try {
            $userId = auth()->user()->id;
            $validator = Validator::make($request->all(), [
                'party_id' => 'required|integer',
                'content' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }
            $parties = DB::table('parties_users')
                ->join('users', 'users.id', '=', 'parties_users.user_id')
                ->select('party_id')
                ->where('active', '=', 1)
                ->where('users.id', '=', $userId)
                ->get()
                ->toArray();

            
            foreach ($parties as $party) {
                if ($party->party_id === intval($request->get('party_id'))) {
                    Message::create([
                        'party_id' => $request->get('party_id'),
                        'content' => $request->get('content'),
                        'user_id' => $userId
                    ]);
                    return response([
                        'success' => true,
                        'message' => 'Message created succeesfully'
                    ], 200);
                }
            }

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'New message was failed',
            ], 400);
        }
    }
}
