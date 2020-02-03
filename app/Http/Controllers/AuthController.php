<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register
     * @param Request $request
     */
    public function register(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $token = $user->createToken('newtoken')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

    /**
     * login
     * @param Request $request
     */
    public function login(Request $request) 
    {
        $validated = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth()->attempt($validated)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $user = Auth()->User();
        $token = $user->createToken('newtoken')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function auth(Request $request) {
        $validated = $request->validate([
            'email' => 'email|required',
            'token' => 'require|required',
        ]);


    }
}
