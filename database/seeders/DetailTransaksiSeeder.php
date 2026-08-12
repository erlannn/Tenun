<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DetailTransaksi::create([
            'id_transaksi' => 1,
            'id_produk' => 1,
            'jumlah' => 2,
            'id_motif' => 1,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_produk' => 2,
            'jumlah' => 1,
            'id_motif' => 2,
        ]);
    }
}