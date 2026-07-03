<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::insert([
            [
                'nm_produk' => 'Tas subahnale',
                'foto' => 'produk6.png',
                'id_kategori' => 1,
                'harga' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produk' => 'Baju kurung pucuk rebung',
                'foto' => 'produk2.png',
                'id_kategori' => 4,
                'harga' => 255000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produk' => 'Baju kurung bunga',
                'foto' => 'produk1.png',
                'id_kategori' => 4,
                'harga' => 240000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produk' => 'Baju bunga mekar',
                'foto' => 'produk4.png',
                'id_kategori' => 4,
                'harga' => 260000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produk' => 'Salempang itik pulang petang',
                'foto' => 'produk3.png',
                'id_kategori' => 5,
                'harga' => 160000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produk' => 'Salempang bunga',
                'foto' => 'produk5.png',
                'id_kategori' => 5,
                'harga' => 170000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}