<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KeranjangController;

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

Route::get('/diskon', [DiskonController::class, 'index']);
Route::post('/hitung-diskon', [DiskonController::class, 'hitungDiskon']);
Route::get('/diskon/{id}', [DiskonController::class, 'show'])->name('diskon.hitung');
Route::post('/diskon/{id}', [DiskonController::class, 'proses'])->name('diskon.proses');
Route::post('/diskon/simpan/{id}', [DiskonController::class, 'simpan'])->name('diskon.simpan');



Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');


Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi/{id}', [TransaksiController::class, 'store'])->name('transaksi.store');

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::get('/keranjang', [KeranjangController::class, 'show'])->name('keranjang.index');
Route::post('/keranjang/tambah', [KeranjangController::class, 'addToCart'])->name('keranjang.add');
Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/update/{id}', [KeranjangController::class, 'updateCart'])->name('keranjang.update');
Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');
Route::get('/keranjang/reset', [KeranjangController::class, 'resetKeranjang'])->name('keranjang.reset');
Route::post('/keranjang/cetak', [KeranjangController::class, 'cetak'])->name('keranjang.cetak');
Route::post('/keranjang/add/{id}', [KeranjangController::class, 'addToCart'])->name('keranjang.add');

Route::get('/', [BarangController::class, 'index']);