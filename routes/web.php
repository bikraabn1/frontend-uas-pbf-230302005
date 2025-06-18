<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[BukuController::class, 'index']);
Route::post('/buku',[BukuController::class, 'store'])->name('buku.store');
Route::put('/buku/{id}',[BukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/{id}',[BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/peminjaman',[PeminjamanController::class, 'index']);
Route::post('/peminjaman',[PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::put('/peminjaman/{id}',[PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/{id}',[PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

