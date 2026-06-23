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
                'nm_produk' => 'Tas Selempang',
                'id_kategori' => 1,
                'harga' => 150000,
            ],
            [
                'nm_produk' => 'Dompet Kulit',
                'id_kategori' => 2,
                'harga' => 75000,
            ],
            [
                'nm_produk' => 'Gantungan Kunci',
                'id_kategori' => 3,
                'harga' => 25000,
            ],
        ]);
    }
}