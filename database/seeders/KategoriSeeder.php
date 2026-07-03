<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::insert([
            ['nm_kategori' => 'Tas'],
            ['nm_kategori' => 'Dompet'],
            ['nm_kategori' => 'Aksesoris'],
            ['nm_kategori' => 'Baju'],
            ['nm_kategori' => 'Selempang'],
        ]);
    }
}