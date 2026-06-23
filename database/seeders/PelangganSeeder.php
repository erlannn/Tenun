<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::create([
            'nm_pelanggan' => 'Ahmad Erlan',
            'no_hp' => '081234567890',
        ]);

        Pelanggan::create([
            'nm_pelanggan' => 'Budi Santoso',
            'no_hp' => '082345678901',
        ]);

        Pelanggan::create([
            'nm_pelanggan' => 'Siti Rahma',
            'no_hp' => '083456789012',
        ]);
    }
}