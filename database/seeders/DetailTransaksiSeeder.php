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
            'motif' => 'Motif Pucuak Rabuang',
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_produk' => 2,
            'jumlah' => 1,
            'motif' => 'Motif Kaluak Paku',
        ]);
    }
}