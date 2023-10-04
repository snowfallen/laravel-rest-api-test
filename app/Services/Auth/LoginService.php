<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->all())) {
            $token = Auth::user()->createToken('ApiToken')->plainTextToken;
            return response()->json([
                'accessToken' => $token,
                'tokenType' => 'Bearer'
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
