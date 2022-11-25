<?php

use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login/Registration
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::apiResource('products', ProductController::class);
});

// Fallback route
Route::fallback(function() {
    return response()->json([
        'statusCode' => 404,
        'results' => null,
        'message' => 'Resource Not Found. If error persists, contact dev@example.com',
    ], 404);
});