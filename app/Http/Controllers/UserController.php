<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        Log::info('Getting user');
    }
    public function updateUser(Request $request)
    {
        Log::info('Updating userName');
        
        try {
            $validator = Validator::make($request->all(), [
                'userName' => 'required|max:255|string',
                
            ]);
     
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }
    
            $user = User::find(auth()->user()->id);
            $user->userName = $request->get('userName'); 
            $user->save();
    
            return response([
                "success"=>true,
                'message'=>'Username updated',
                'data'=> $user->userName
            ], 200); 
        } catch (\Throwable $th) {
            Log::error('Error updating Username: ' . $th->getMessage());

            return response([
                'success' => false,
                'message' => 'Update user fails',
            ], 400);
        }
    }
    
}
