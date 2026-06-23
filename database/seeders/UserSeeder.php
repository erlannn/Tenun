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
            'name' => 'Owner',
            'username' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Owner');

        User::create([
            'name' => 'Kasir',
            'username' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Kasir');
    }
}
