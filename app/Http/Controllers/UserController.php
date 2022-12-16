<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        Log::info('Getting user');
        try {
            $users = User::all()->toArray();
            return response([
                'success'=> true,
                'message'=> 'Users retrieving successfully',
                'data'=> $users
            ]);

        } catch (\Throwable $th) {
            Log::error('Error getting Username: ' . $th->getMessage());

            return response([
                'success' => false,
                'message' => 'Get user fails',
            ], 400);
        }
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

    public function deleteUser()
    {
        Log::info('Dropping user');

        try {
            
            $isAdmin = DB::table('role_user')
                        ->where('user_id', '=', auth()->user()->id)
                        ->where('role_id', '=', 3)
                        ->get()
                        ->toArray();
            if (count($isAdmin) !== 0) {
                return response([
                    'success'=> true,
                    'message'=> 'Admins, and SuperAdmins cant be deleted'
                ], 400);
            }
            $user = User::find(auth()->user()->id);
            $user->delete();
            return response([
                'success'=> true,
                'message'=>'Profile deleted',
            ], 200);


        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Fail dropping user',
            ], 400);
        }
    }
    
}
