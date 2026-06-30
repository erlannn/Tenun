<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        Satuan::insert([
            ['nm_satuan' => 'Meter'],
            ['nm_satuan' => 'Roll'],
            ['nm_satuan' => 'Pack'],
        ]);
    }
}
