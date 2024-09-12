<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Register as RegisterCtrl;

Route::post('/register', RegisterCtrl::class)->name('register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
