<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    const USER_ROLE_ID = 2;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'userName' => $request->get('userName'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password)
        ]);
        $token = JWTAuth::fromUser($user);
        $user->roles()->attach(self::USER_ROLE_ID);
        
        return response()->json(compact('user', 'token'), 201);
    }
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        try {
            //JWTAuth::invalidate($request->token);
            auth()->logout();
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }
}
