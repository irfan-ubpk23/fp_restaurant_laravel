<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\KategoriController;

Route::controller(UserController::class)->group(function(){
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('kategoris', KategoriController::class);
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user');
});

