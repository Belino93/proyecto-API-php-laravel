<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    //Get message by id
    public function getMessageById(){
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
}
