<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/transaksi-bahan', function () {
    return view('transaksi-bahan');
});

Route::get('/data-produk', function () {
    return view('data-produk');
});

