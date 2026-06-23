<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('datang');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/datang', function () {
//     return view('datang');
// })->middleware(['auth', 'verified'])->name('datang');

Route::get('/transaksi-bahan', function () {
    return view('transaksi-bahan');
})->middleware(['auth', 'verified'])->name('transaksi-bahan');

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/data-produk', function () {
        return view('produk.data-produk');
    })->name('data-produk');
});

require __DIR__.'/auth.php';
