<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/check', function () {
    return response()->json([
        'message' => 'API is working!'
    ]);
});

Route::post('/login',[AuthController::class,'login']);
