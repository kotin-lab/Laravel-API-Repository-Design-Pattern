<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);

        // Check validation failed
        if ($validator->fails()) {
            return jsonResponse(null, 400, 'Validation error', $validator->errors());
        }

        // Validate fields
        $validated = $validator->validated();

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
    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Check validation failed
        if ($validator->fails()) {
            return jsonResponse(null, 400, 'Validation error', $validator->errors());
        }

        // Validate fields
        $validated = $validator->validated();

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
}
