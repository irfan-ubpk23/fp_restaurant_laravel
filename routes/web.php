<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\OrderController;

use App\Http\Middleware\UserIsAdmin;
use App\Http\Middleware\UserIsDapur;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(UserIsAdmin::class)->group(function() {
    Route::get('/dashboard', [HomeController::class, 'dashboard']);
    
    Route::controller(KategoriController::class)->group(function() {
        Route::get('/kategori', 'index')->name('kategori');
        Route::post("/kategori", 'store')->name("kategori.store");
        Route::put("/kategori/{id}", 'update')->name("kategori.update");
        Route::delete('/kategori/{id}', 'destroy')->name("kategori.destroy");
    });
    
    Route::controller(MenuController::class)->group(function() {
        Route::get('/menu', 'index')->name("menu");
        Route::post('/menu', 'store')->name('menu.store');
        Route::put('/menu/{id}', 'update')->name('menu.update');
        Route::delete('/menu/{id}', 'destroy')->name('menu.destroy');
    });

    Route::controller(MejaController::class)->group(function(){
        Route::get('/meja', 'index')->name('meja');
        Route::post('/meja', 'store')->name('meja,store');
        Route::put('/meja/{id}', 'update')->name('meja.update');
        Route::delete('/meja/{id}', 'destroy')->name('meja.destroy');
    });
    
    Route::controller(ReservasiController::class)->group(function(){
        Route::get('/reservasi', 'index')->name('reservasi');
    });

    Route::controller(MetodePembayaranController::class)->group(function(){
        Route::get("/metode_pembayaran", 'index')->name("metode_pembayaran");
        Route::post("/metode_pembayaran", 'store')->name("metode_pembayaran.store");
        Route::put("/metode_pembayaran/{id}", "update")->name("metode_pembayaran.update");
        Route::delete("/metode_pembayaran/{id}", "destroy")->name("metode_pembayaran.destroy");
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get("/order", "index")->name("order");
        Route::post("/order", "store")->name("order.store");
        Route::put("/order/{id}", "update")->name("order.update");
        Route::delete("/order/{id}", "destroy")->name("order.destroy");
    });
});