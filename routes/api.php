<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([ValidateJWT::class])->group(function () {
    Route::get('/jwt-test', function () {
        return response()->json(['message' => 'You have access!']);
    });
});
