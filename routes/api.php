<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Register as RegisterCtrl;
use App\Http\Controllers\Api\Login as LoginCtrl;

Route::post('/register', RegisterCtrl::class)->name('register');
Route::post('/login', LoginCtrl::class)->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
