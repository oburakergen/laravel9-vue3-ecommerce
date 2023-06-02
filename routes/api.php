<?php

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
Route::post('/sanctum/token', \App\Http\Controllers\TokenController::class);
Route::apiResource('/products', \App\Http\Controllers\Api\ProductApi::class);
Route::apiResource('/basket', \App\Http\Controllers\Api\BasketApi::class);
Route::apiResource('/transaction', \App\Http\Controllers\Api\TransactionApi::class);


Route::get('/user', function (Request $request) {
    $token = $request->header('Authorization');

    $check = \Laravel\Sanctum\PersonalAccessToken::findToken($token);

    if ($check) {
        $user = \App\Models\User::find( $check->tokenable_id);

        return response()->json($user);
    }

    return response()->json(["message" => "Un"],400);
});
