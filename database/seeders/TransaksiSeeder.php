<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        Transaksi::create([
            'id_pelanggan' => 1,
            'tanggal_pesan' => now(),
            'tanggal_selesai' => now()->addDays(7),
            'jenis_transaksi' => 'PreOrder',
            'status' => 'diproses',
        ]);

        Transaksi::create([
            'id_pelanggan' => 2,
            'tanggal_pesan' => now(),
            'tanggal_selesai' => now()->addDays(14),
            'jenis_transaksi' => 'PreOrder',
            'status' => 'selesai',
        ]);
    }
}