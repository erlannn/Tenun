<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiBahanController;
use App\Http\Controllers\BahanController;
use Illuminate\Support\Facades\Route;




Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');


Route::get('/', [ProductController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/transaksi-bahan', [TransaksiBahanController::class, 'index'])->middleware(['auth'])->name('transaksi-bahan');

    Route::get('/transaksi-bahan/create', [TransaksiBahanController::class, 'create'])->middleware(['auth'])->name('transaksi-bahan.create');
    Route::post('/transaksi-bahan', [TransaksiBahanController::class, 'store'])->middleware(['auth'])->name('transaksi-bahan.store');
    Route::get('/transaksi-bahan/{id}', [TransaksiBahanController::class, 'show'])->middleware(['auth'])->name('transaksi-bahan.show');

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/data-produk', [ProductController::class, 'index'])->name('data-produk');
    // Create
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    // Edit / Update
    // Ubah {product} menjadi {produk} agar sinkron dengan (Produk $produk) di Controller
    Route::get('/produk/{produk}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}', [ProductController::class, 'update'])->name('produk.update');
    // Delete
    Route::delete('/produk/{produk}', [ProductController::class, 'destroy'])->name('produk.destroy');

    Route::get('/data-bahan', [BahanController::class, 'index'])->name('data-bahan');
    Route::get('/bahan/create', [BahanController::class, 'create'])->name('bahan.create');
    Route::post('/bahan/store', [BahanController::class, 'store'])->name('bahan.store');
    Route::get('/bahan/{bahan}/edit', [BahanController::class, 'edit'])->name('bahan.edit');
    Route::put('/bahan/{bahan}', [BahanController::class, 'update'])->name('bahan.update');
    Route::delete('/bahan/{bahan}', [BahanController::class, 'destroy'])->name('bahan.destroy');
});

require __DIR__ . '/auth.php';
