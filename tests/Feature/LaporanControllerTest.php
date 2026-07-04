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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_laporan_menampilkan_total_yang_sesuai_untuk_setiap_jenis_transaksi(): void
    {
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
            'nm_satuan' => 'Meter',
        ]);

        $bahan = Bahan::create([
            'nm_bahan' => 'Kain',
            'id_satuan' => $satuan->id_satuan,
            'harga' => 5000,
            'stok' => 100,
        ]);

        $preorder = Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tanggal_pesan' => now()->toDateString(),
            'jenis_transaksi' => 'PreOrder',
            'status' => 'diproses',
        ]);

        $detailPreorder = DetailTransaksi::create([
            'id_transaksi' => $preorder->id_transaksi,
            'id_produk' => $produk->id_produk,
            'jumlah' => 3,
            'motif' => 'Polos',
        ]);

        $bahanTransaksi = Transaksi::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'tanggal_pesan' => now()->toDateString(),
            'jenis_transaksi' => 'Bahan',
        ]);

        $detailBahanTransaksi = DetailTransaksi::create([
            'id_transaksi' => $bahanTransaksi->id_transaksi,
            'id_produk' => $produk->id_produk,
            'jumlah' => 2,
            'motif' => null,
        ]);

        DetailBahan::create([
            'id_detail' => $detailBahanTransaksi->id_detail,
            'id_bahan' => $bahan->id_bahan,
            'jumlah_bahan' => 2,
        ]);

        $response = $this->get('/laporan');

        $response->assertOk();
        $response->assertSee('Rp. 30.000');
        $response->assertSee('Rp. 10.000');
        $response->assertSee('Rp. 40.000');
    }
}
