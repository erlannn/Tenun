<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari_tanggal = $request->input('dari_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');
        $jenis_transaksi = $request->input('jenis_transaksi');
        $cari = $request->input('cari');

        $query = $this->buildQuery($request);

        // Hitung total untuk setiap transaksi berdasarkan jenis transaksi
        $calculateTransactionTotal = function (Transaksi $transaksi): int {
            if (strtolower($transaksi->jenis_transaksi ?? '') === 'preorder') {
                return (int) $transaksi->detailTransaksi->sum(function ($detail) {
                    return ($detail->produk->harga ?? 0) * ($detail->jumlah ?? 0);
                });
            }

            return (int) $transaksi->detailTransaksi->sum(function ($detail) {
                return $detail->detailBahan->sum(function ($detailBahan) {
                    return ($detailBahan->bahan->harga ?? 0) * ($detailBahan->jumlah_bahan ?? 0);
                });
            });
        };

        // Ambil data Utama dengan Pagination
        $transaksi = $query->orderBy('tanggal_pesan', 'desc')->paginate(10)->withQueryString();
        $transaksi->getCollection()->transform(function ($item) use ($calculateTransactionTotal) {
            $item->setAttribute('total_laporan', $calculateTransactionTotal($item));
            return $item;
        });

        // 4. Hitung Akumulasi Total Keseluruhan Berdasarkan Jenis Transaksi yang Sama
        $total_keseluruhan = $query->get()->sum($calculateTransactionTotal);

        $sudah_filter = !empty($dari_tanggal) || !empty($sampai_tanggal) || !empty($jenis_transaksi) || !empty($cari);

        return view('laporan', compact('transaksi', 'total_keseluruhan', 'sudah_filter'));
    }

    public function cetakPdf(Request $request)
    {
        $query = $this->buildQuery($request);

        $transaksi = $query->orderBy('tanggal_pesan', 'desc')->get();

        $calculateTransactionTotal = function (Transaksi $transaksi): int {
            if (strtolower($transaksi->jenis_transaksi ?? '') === 'preorder') {
                return (int) $transaksi->detailTransaksi->sum(function ($detail) {
                    return ($detail->produk->harga ?? 0) * ($detail->jumlah ?? 0);
                });
            }

            return (int) $transaksi->detailTransaksi->sum(function ($detail) {
                return $detail->detailBahan->sum(function ($detailBahan) {
                    return ($detailBahan->bahan->harga ?? 0) * ($detailBahan->jumlah_bahan ?? 0);
                });
            });
        };

        $transaksi->transform(function ($item) use ($calculateTransactionTotal) {
            $item->setAttribute('total_laporan', $calculateTransactionTotal($item));
            return $item;
        });

        $total_keseluruhan = $transaksi->sum(function ($item) {
            return $item->getAttribute('total_laporan') ?? 0;
        });

        $pdf = Pdf::loadView('view.pdf', [
            'transaksi' => $transaksi,
            'total_keseluruhan' => $total_keseluruhan,
            'dari_tanggal' => $request->input('dari_tanggal'),
            'sampai_tanggal' => $request->input('sampai_tanggal'),
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'cari' => $request->input('cari'),
        ]);

        return $pdf->download('laporan-transaksi.pdf');
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
