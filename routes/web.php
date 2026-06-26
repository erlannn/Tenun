<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transaksi-bahan', function () {
    return view('transaksi-bahan.transaksi-bahan');
})->middleware(['auth', 'verified'])->name('transaksi-bahan');

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

});

require __DIR__.'/auth.php';
?>
