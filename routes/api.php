<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\OrderController;

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login')->name('login');
    Route::post('/check_user', 'check_user')->name("check_user");
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post("/order/{id}", [OrderController::class, 'update']);
    // Route::apiResource('kategoris', KategoriController::class);
    // Route::get('user', function (Request $request) {
    //     return $request->user();
    // })->name('user');
});

