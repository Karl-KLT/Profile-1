<?php

namespace App\Repositories;

class AuthRepository
{

    public function login()
    {
        if (! $token = auth('api')->attempt(request()->only('email','password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function me()
    {
        return auth('api')->user();
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'status' => 200, 
            'message' => 'successfully' 
        ];
    }
}