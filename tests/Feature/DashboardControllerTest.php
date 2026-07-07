<?php

namespace Tests\Feature;

use App\Models\Bahan;
use App\Models\DetailBahan;
use App\Models\DetailTransaksi;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Satuan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_menampilkan_data_harian_stok_kritis_dan_grafik_30_hari(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $pelanggan = Pelanggan::create([
            'nm_pelanggan' => 'Budi',
            'no_hp' => '08123456789',
        ]);

        $kategori = Kategori::create([
            'nm_kategori' => 'Pakaian',
        ]);

        $produk = Produk::create([
            'nm_produk' => 'Baju',
            'id_kategori' => $kategori->id_kategori,
            'harga' => 10000,
        ]);

        $satuan = Satuan::create([
            'nm_satuan' => 'Rol',
        ]);

        $bahanKritis = Bahan::create([
            'nm_bahan' => 'Benang Emas',
            'id_satuan' => $satuan->id_satuan,
            'harga' => 5000,
            'stok' => 5,
        ]);

        $bahanAman = Bahan::create([
            'nm_bahan' => 'Benang Katun',
            'id_satuan' => $satuan->id_satuan,
            'harga' => 3000,
            'stok' => 20,
        ]);

        $todayPreorder = Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tanggal_pesan' => now()->toDateString(),
            'jenis_transaksi' => 'PreOrder',
            'status' => 'diproses',
        ]);

        DetailTransaksi::create([
            'id_transaksi' => $todayPreorder->id_transaksi,
            'id_produk' => $produk->id_produk,
            'jumlah' => 2,
            'motif' => 'Polos',
        ]);

        $todayBahan = Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tanggal_pesan' => now()->toDateString(),
            'jenis_transaksi' => 'Bahan',
            'status' => 'diproses',
        ]);

        $todayBahanDetail = DetailTransaksi::create([
            'id_transaksi' => $todayBahan->id_transaksi,
            'id_produk' => $produk->id_produk,
            'jumlah' => 1,
            'motif' => null,
        ]);

        DetailBahan::create([
            'id_detail' => $todayBahanDetail->id_detail,
            'id_bahan' => $bahanKritis->id_bahan,
            'jumlah_bahan' => 1,
        ]);

        $yesterdayPreorder = Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tanggal_pesan' => now()->subDay()->toDateString(),
            'jenis_transaksi' => 'PreOrder',
            'status' => 'diproses',
        ]);

        DetailTransaksi::create([
            'id_transaksi' => $yesterdayPreorder->id_transaksi,
            'id_produk' => $produk->id_produk,
            'jumlah' => 3,
            'motif' => 'Kembang',
        ]);

        $thirtyDaysAgo = Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tanggal_pesan' => now()->subDays(29)->toDateString(),
            'jenis_transaksi' => 'Bahan',
            'status' => 'diproses',
        ]);

        $thirtyDaysAgoDetail = DetailTransaksi::create([
            'id_transaksi' => $thirtyDaysAgo->id_transaksi,
            'id_produk' => $produk->id_produk,
            'jumlah' => 1,
            'motif' => null,
        ]);

        DetailBahan::create([
            'id_detail' => $thirtyDaysAgoDetail->id_detail,
            'id_bahan' => $bahanKritis->id_bahan,
            'jumlah_bahan' => 2,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee((string) 2);
        $response->assertSee((string) 1);
        $response->assertSee('Benang Emas');
        $response->assertSee('Sisa 5 Rol');
        $response->assertDontSee('Benang Katun');
        $response->assertSee('data-chart');
    }
}