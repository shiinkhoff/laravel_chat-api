<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $userData = [
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($userData);
        $token = $user->createToken('chatdansosmed1')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 422);
        }

        $token = $user->createToken('chatdansosmed1')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
