<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        if (!$token = Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            abort(401);
        }

        return $this->respondWithToken($token);

    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
