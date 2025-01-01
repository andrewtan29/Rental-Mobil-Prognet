<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', action: [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index.view');
    Route::get('/pelanggan/create', [PelangganController::class, 'createView'])->name('pelanggan.create.view');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'editView'])->name('pelanggan.edit.view');
    Route::post('/pelanggan', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::get('/pelanggan/{id}/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');

    Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index.view');
    Route::get('/mobil/create', [MobilController::class, 'createView'])->name('mobil.create.view');
    Route::get('/mobil/{id}/edit', [MobilController::class, 'editView'])->name('mobil.edit.view');
    Route::post('/mobil', [MobilController::class, 'create'])->name('mobil.create');
    Route::put('/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');
    Route::get('/mobil/{id}/delete', [MobilController::class, 'delete'])->name('mobil.delete');

    Route::get('/transaksi/create', [TransaksiController::class, 'createView'])->name('transaksi.create.view');
    Route::post('/transaksi', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/transaksi/{id}/delete', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    Route::get('/transaksi/{id}/complete', [TransaksiController::class, 'complete'])->name('transaksi.complete');
    Route::get('/transaksi/{id}/cetak-nota', [TransaksiController::class, 'cetakNota'])->name('transaksi.cetak-nota');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
