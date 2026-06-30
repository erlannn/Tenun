<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        Bahan::create([
            'id_satuan' => '1',
            'nm_bahan' => 'Benang Sutra',
            'harga' => 15000,
            'stok' => 100,
        ]);

        Bahan::create([
            'id_satuan' => '3',
            'nm_bahan' => 'Pewarna Alami',
            'harga' => 25000,
            'stok' => 50,
        ]);

        Bahan::create([
            'id_satuan' => '1',
            'nm_bahan' => 'Benang Katun',
            'harga' => 10000,
            'stok' => 200,
        ]);
    }
}