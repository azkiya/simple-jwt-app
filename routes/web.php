<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateJWT;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([ValidateJWT::class])->group(function () {
    Route::get('/jwt-test', function () {
        return response()->json(['message' => 'You have access!']);
    });
});
