<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function login(Request $request)
    {
        //1234=>$2y$10$dhQZqV0UjLc97XUdNYa7u.U6vvfN7jQIkQ32.4EYvWYeoOBjc35z.
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'login information invalid',
            ], 401);
        }
        $user = User::where('email', $validated['email'])->first();
        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);
        $user=User::create($validated);
        return response()->json([
            'data'=>$user,
            'access_token'=>$user->createToken('api_token')->plainTextToken,
            'token_type'=>'Bearer'
        ],201);
    }
}
