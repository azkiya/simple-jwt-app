<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Middleware\ValidateJWT;

Route::get('/test', function () {
    return response()->json(['message' => 'You have access, this route without jwt!']);
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware([ValidateJWT::class])->group(function () {
    Route::get('/jwt-test', function () {
        return response()->json(['message' => 'You have access!']);
    });

    Route::resource('packages', PackageController::class);
});
