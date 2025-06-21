<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\MejaController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderDetailController;
use App\Http\Controllers\API\ReservasiController;
use App\Http\Controllers\API\TransaksiController;

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login')->name('login');
    Route::post('/check_user', 'check_user')->name("check_user");
});

Route::middleware('auth:sanctum')->group(function(){
    Route::controller(KategoriController::class)->group(function(){
        Route::get("/kategoris", 'index');
        Route::post("/kategoris", 'store');
        Route::put('/kategoris/{id}', 'update');
        Route::delete("/kategoris/{id}", 'destroy');
    });

    Route::controller(MejaController::class)->group(function(){
        Route::get("/mejas", 'index');
        Route::post("/mejas", 'store');
        Route::put('/mejas/{id}', 'update');
        Route::delete("/mejas/{id}", 'destroy');
    });
    
    Route::controller(OrderController::class)->group(function(){
        Route::get("/orders", 'index');
        Route::post("/orders", 'store');
        Route::put('/orders/{id}', 'update');
        Route::delete("/orders/{id}", 'destroy');
    });

    Route::controller(OrderDetailController::class)->group(function(){
        Route::get("/order_details", 'index');
        Route::post("/order_details", 'store');
        Route::put('/order_details/{id}', 'update');
        Route::delete("/order_details/{id}", 'destroy');
    });

    Route::controller(ReservasiController::class)->group(function(){
        Route::get("/reservasis", 'index');
        Route::post("/reservasis", 'store');
        Route::put('/reservasis/{id}', 'update');
        Route::delete("/reservasis/{id}", 'destroy');
    });

    Route::controller(TransaksiController::class)->group(function(){
        Route::get("/transaksis", 'index');
        Route::post("/transaksis", 'store');
        Route::put('/transaksis/{id}', 'update');
        Route::delete("/transaksis/{id}", 'destroy');
    });
});

