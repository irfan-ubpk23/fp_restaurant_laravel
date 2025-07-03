<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
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
    Route::post('/check_token', 'check_token');
    Route::post("/register", 'register')->name("register");
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post("/logout", [AuthController::class, 'logout']);

    Route::controller(UserController::class)->group(function(){
        Route::put('/users/{id}', 'update');
    });

    Route::controller(KategoriController::class)->group(function(){
        Route::get("/kategoris", 'index');
        Route::post("/kategoris", 'store');
        Route::put('/kategoris/{id}', 'update');
        Route::delete("/kategoris/{id}", 'destroy');
    });

    Route::controller(MenuController::class)->group(function(){
        Route::get("/menus", 'index');
        Route::get("/menus/{id}", 'show');
        Route::post("/menus", "store");
        Route::put("/menus/{id}", 'update');
        Route::delete("/menus/{id}", 'destroy');

        Route::get("/menus/terlaris/{range}", "terlaris");
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
        Route::get("/transaksis/today/", 'today');
        Route::get("/transaksis/overview/{mode}", 'overview');
        
        Route::get("/transaksis/user/{id}", 'where_user_id');
        Route::get("/transaksis/kode_transaksi/{kode_transaksi}", 'where_kode_transaksi');
        
        Route::get("/transaksis", 'index');
        Route::post("/transaksis", 'store');
        Route::post('/transaksis/{id}', 'update');
        Route::get('/transaksis/{id}', 'show');
        Route::delete("/transaksis/{id}", 'destroy');
    });
});

