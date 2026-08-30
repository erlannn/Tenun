<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Spatie\LaravelPdf\Facades\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari_tanggal = $request->input('dari_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');
        $jenis_transaksi = $request->input('jenis_transaksi');
        $cari = $request->input('cari');

        $query = $this->buildQuery($request);

        // Ambil data Utama dengan Pagination
        $transaksi = $query->orderBy('tanggal_pesan', 'desc')->paginate(10)->withQueryString();
        $transaksi->getCollection()->transform(function ($item) {
            $item->setAttribute('total_laporan', $this->calculateTransactionTotal($item));
            return $item;
        });

        // 4. Hitung Akumulasi Total Keseluruhan Berdasarkan Jenis Transaksi yang Sama
        $total_keseluruhan = $query->get()->sum(function ($item) {
            return $this->calculateTransactionTotal($item);
        });

        $sudah_filter = !empty($dari_tanggal) || !empty($sampai_tanggal) || !empty($jenis_transaksi) || !empty($cari);
        
        return view('laporan', compact('transaksi', 'total_keseluruhan', 'sudah_filter'));
    }

    public function cetakPdf(Request $request)
    {
        $query = $this->buildQuery($request);

        $transaksi = $query->orderBy('tanggal_pesan', 'desc')->get();

        $transaksi->transform(function ($item) {
            $item->setAttribute('total_laporan', $this->calculateTransactionTotal($item));
            return $item;
        });

        $total_keseluruhan = $transaksi->sum(function ($item) {
            return $item->getAttribute('total_laporan') ?? 0;
        });

        $pdf = Pdf::View('view.pdf', [
            'transaksi' => $transaksi,
            'total_keseluruhan' => $total_keseluruhan,
            'dari_tanggal' => $request->input('dari_tanggal'),
            'sampai_tanggal' => $request->input('sampai_tanggal'),
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'cari' => $request->input('cari'),
        ]);

        return $pdf->download('laporan-transaksi.pdf');
    }

    protected function calculateTransactionTotal(Transaksi $transaksi): int
    {
        if (strtolower($transaksi->jenis_transaksi ?? '') === 'preorder') {
            $totalProduk = (int) $transaksi->detailTransaksi->sum(function ($detail) {
                return ($detail->produk->harga ?? 0) * ($detail->jumlah ?? 0);
            });

            $totalBahan = (int) $transaksi->detailTransaksi->sum(function ($detail) {
                return $detail->detailBahan->sum(function ($detailBahan) {
                    return ($detailBahan->bahan->harga ?? 0) * ($detailBahan->jumlah_bahan ?? 0);
                });
            });

            return $totalProduk + $totalBahan;
        }

        return (int) $transaksi->detailTransaksi->sum(function ($detail) {
            return $detail->detailBahan->sum(function ($detailBahan) {
                return ($detailBahan->bahan->harga ?? 0) * ($detailBahan->jumlah_bahan ?? 0);
            });
        });
    }

    protected function buildQuery(Request $request)
    {
        $dari_tanggal = $request->input('dari_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');
        $jenis_transaksi = $request->input('jenis_transaksi');
        $cari = $request->input('cari');

        $query = Transaksi::with([
            'pelanggan',
            'detailTransaksi.produk',
            'detailTransaksi.detailBahan.bahan',
        ]);

        if ($dari_tanggal) {
            $query->whereDate('tanggal_pesan', '>=', $dari_tanggal);
        }
        if ($sampai_tanggal) {
            $query->whereDate('tanggal_pesan', '<=', $sampai_tanggal);
        }
        if ($jenis_transaksi) {
            $query->where('jenis_transaksi', $jenis_transaksi);
        }
        if ($cari) {
            $query->whereHas('pelanggan', function ($q) use ($cari) {
                $q->where('nm_pelanggan', 'like', '%' . $cari . '%');
            });
        }

        return $query;
    }
}
