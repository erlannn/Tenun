<?php

namespace Database\Seeders;

use App\Models\Motif;
use Illuminate\Database\Seeder;

class MotifSeeder extends Seeder
{
    public function run(): void
    {
        Motif::insert([
            ['nm_motif' => 'Motif Pucuak Rabuang'],
            ['nm_motif' => 'Motif Kaluak Paku'],
            ['nm_motif' => 'Motif Saik Kalamai'],
            ['nm_motif' => 'Motif Bunga Lada'],
            ['nm_motif' => 'Motif Itak Sianok'],
            ['nm_motif' => 'Motif Siriah'],
        ]);
    }
}
