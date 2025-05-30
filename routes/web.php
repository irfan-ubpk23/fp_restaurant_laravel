<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;

Route::get('/', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::post("/kategori", [KategoriController::class, 'store'])->name("kategori.store");
Route::put("/kategori/{id}", [KategoriController::class, 'update'])->name("kategori.update");
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name("kategori.destroy");
