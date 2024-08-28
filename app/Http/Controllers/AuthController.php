<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return response()->json([
                'token' => Auth::user()->createToken('token')->plainTextToken,
            ]);
        }
        abort(401);
    }

    public function logout()
    {
        Auth::logout();

        return response()->noContent();
    }
}
