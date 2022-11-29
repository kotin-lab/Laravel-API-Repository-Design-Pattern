<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(StoreUserRequest $request)
    {
        // Validate fields
        $validated = $request->validated();

        // Create new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Generate token
        $token = $user->createToken('Laravel8PassportAuth')->accessToken;

        return jsonResponse([
            'token' => $token
        ], 200, 'Success');
    }


    /**
     * Login
     */
    public function login(LoginUserRequest $request)
    {
        // Validate fields
        $validated = $request->validated();

        if (auth()->attempt($validated)) {
            $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;

            return jsonResponse([
                'token' => $token
            ], 200, 'Success');
        } else {
            return jsonResponse(null, 401, 'Unauthorized');
        }
    }


    /**
     * User info
     */
    public function userInfo()
    {
        $user = auth()->user();

        return (new UserResource($user))->additional([
            'statusCode' => 200,
            'message' => 'Success'
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $token = Auth::user()->token();
        $token->revoke();

        return jsonResponse(null, 200, 'User logout uccessfully');
    }
}
