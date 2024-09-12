<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateJWT;

Route::get('/', function () {
    return view('welcome');
});
