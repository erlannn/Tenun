<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission Bahan
        Permission::create(['name' => 'create_bahan']);
        Permission::create(['name' => 'edit_bahan']);
        Permission::create(['name' => 'delete_bahan']);
        Permission::create(['name' => 'view_bahan']);

        // Permission Detail Bahan
        Permission::create(['name' => 'create_detail_bahan']);
        Permission::create(['name' => 'edit_detail_bahan']);
        Permission::create(['name' => 'delete_detail_bahan']);
        Permission::create(['name' => 'view_detail_bahan']);

        // Permission Kategori
        Permission::create(['name' => 'create_kategori']);
        Permission::create(['name' => 'edit_kategori']);
        Permission::create(['name' => 'delete_kategori']);
        Permission::create(['name' => 'view_kategori']);

        // Permission Pelanggan
        Permission::create(['name' => 'create_pelanggan']);
        Permission::create(['name' => 'edit_pelanggan']);
        Permission::create(['name' => 'delete_pelanggan']);
        Permission::create(['name' => 'view_pelanggan']);

        // Permission Detail Transaksi
        Permission::create(['name' => 'create_detail_transaksi']);
        Permission::create(['name' => 'edit_detail_transaksi']);
        Permission::create(['name' => 'delete_detail_transaksi']);
        Permission::create(['name' => 'view_detail_transaksi']);

        // Permission Produk
        Permission::create(['name' => 'create_produk']);
        Permission::create(['name' => 'edit_produk']);
        Permission::create(['name' => 'delete_produk']);
        Permission::create(['name' => 'view_produk']);

        // Permission Transaksi
        Permission::create(['name' => 'create_transaksi']);
        Permission::create(['name' => 'edit_transaksi']);
        Permission::create(['name' => 'delete_transaksi']);
        Permission::create(['name' => 'view_transaksi']);

        // Permission User
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'edit_user']);
        Permission::create(['name' => 'delete_user']);
        Permission::create(['name' => 'view_user']);

        // Role Admin
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // Role Karyawan
        $roleKaryawan = Role::create(['name' => 'Karyawan']);
        $roleKaryawan->givePermissionTo([
            'view_transaksi',
            'create_transaksi',
            'view_detail_transaksi',
            'create_detail_transaksi',
            'view_produk',
            'view_pelanggan',
        ]);
    }
}
