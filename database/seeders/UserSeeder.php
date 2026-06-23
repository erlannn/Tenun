<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Karyawan',
            'username' => 'karyawan',
            'email' => 'Karyawan@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Karyawan');
    }
}
