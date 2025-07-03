<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;

use App\Http\Middleware\UserIsAdmin;
use App\Http\Middleware\UserIsDapur;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [HomeController::class, 'dashboard']);
});

Route::middleware(UserIsAdmin::class)->group(function() {
    Route::get('/laporan', [HomeController::class, 'admin_laporan']);
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

    Route::controller(UserController::class)->group(function(){
        Route::get("/user", "index")->name("user");
        Route::post("/user", "store")->name("user.store");
        Route::put("/user/{id}", "update")->name("user.update");
        Route::delete("/user/{id}", "destroy")->name("user.destroy");
    });
    
    Route::controller(ReservasiController::class)->group(function(){
        Route::get('/reservasi', 'index')->name('reservasi');
    });

    Route::controller(TransaksiController::class)->group(function(){
        Route::get('/transaksi', 'index')->name('transaksi');
    });
});