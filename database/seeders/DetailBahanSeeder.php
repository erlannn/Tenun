<?php

namespace Database\Seeders;

use App\Models\DetailBahan;
use Illuminate\Database\Seeder;

class DetailBahanSeeder extends Seeder
{
    public function run(): void
    {
        DetailBahan::create([
            'id_detail' => 1,
            'id_bahan' => 1,
            'jumlah_bahan' => 10,
        ]);

        DetailBahan::create([
            'id_detail' => 1,
            'id_bahan' => 2,
            'jumlah_bahan' => 2,
        ]);

        DetailBahan::create([
            'id_detail' => 2,
            'id_bahan' => 3,
            'jumlah_bahan' => 8,
        ]);
    }
}