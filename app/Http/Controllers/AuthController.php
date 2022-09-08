<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $accessToken = $user->createToken('accessToken')->accessToken;

            return response()->json([
                'message' => 'login successfully',
                'status' => 'success',
                'accessToken' => $accessToken,
            ], 200);
        }

        return response()->json([
            'message' => 'wrong email or password',
            'status' => 'fail',
        ], 403);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $users = User::where('email', $request->email)->first();
        if($users){
            return response()->json([
                'message' => 'email already exists',
                'status' => 'fail',
            ], 409);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'message' => 'user created',
            'status' => 'success',
        ], 201);
    }
}
