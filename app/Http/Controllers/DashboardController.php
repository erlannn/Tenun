<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Transaksi;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $startDate = now()->subDays(29)->toDateString();

        $totalTransaksiHariIni = Transaksi::where('tanggal_pesan', '=', $today, 'and')->count();
        $totalPreorderHariIni = Transaksi::where('tanggal_pesan', '=', $today, 'and')
            ->whereRaw('LOWER(jenis_transaksi) = ?', ['preorder'])
            ->count();
        $totalPenjualanBahanHariIni = Transaksi::where('tanggal_pesan', '=', $today, 'and')
            ->whereRaw('LOWER(jenis_transaksi) = ?', ['bahan'])
            ->count();

        $stokKritis = Bahan::with('satuan')
            ->where('stok', '<', 10)
            ->orderBy('stok')
            ->orderBy('nm_bahan')
            ->get()
            ->map(function (Bahan $bahan) {
                $satuan = optional($bahan->satuan)->nm_satuan;

                return [
                    'nama' => $bahan->nm_bahan,
                    'sisa' => $satuan ? 'Sisa ' . $bahan->stok . ' ' . $satuan : 'Sisa ' . $bahan->stok,
                ];
            });

        $chartLabels = [];
        $chartPreorder = [];
        $chartBahan = [];

        $dailyCounts = Transaksi::query()
            ->selectRaw('DATE(tanggal_pesan) as tanggal, LOWER(jenis_transaksi) as jenis, COUNT(*) as total', [])
            ->where('tanggal_pesan', '>=', $startDate, 'and')
            ->groupBy(DB::raw('DATE(tanggal_pesan)'), DB::raw('LOWER(jenis_transaksi)'))
            ->get();

        $countsByDate = [];
        foreach ($dailyCounts as $row) {
            $countsByDate[$row->tanggal][$row->jenis] = (int) $row->total;
        }

        foreach (CarbonPeriod::create($startDate, $today) as $date) {
            $dateString = $date->toDateString();
            $chartLabels[] = $date->format('d M');
            $chartPreorder[] = $countsByDate[$dateString]['preorder'] ?? 0;
            $chartBahan[] = $countsByDate[$dateString]['bahan'] ?? 0;
        }

        $chartData = [
            'labels' => $chartLabels,
            'datasets' => [
                [
                    'label' => 'Preorder',
                    'data' => $chartPreorder,
                    'borderColor' => '#004D39',
                    'backgroundColor' => 'transparent',
                    'borderWidth' => 1.5,
                    'pointBackgroundColor' => '#004D39',
                    'pointRadius' => 3,
                    'tension' => 0,
                ],
                [
                    'label' => 'Penjualan Bahan',
                    'data' => $chartBahan,
                    'borderColor' => '#D4AF37',
                    'backgroundColor' => 'transparent',
                    'borderWidth' => 1.5,
                    'pointBackgroundColor' => '#D4AF37',
                    'pointRadius' => 3,
                    'tension' => 0,
                ],
            ],
        ];

        return view('dashboard', compact(
            'totalTransaksiHariIni',
            'totalPreorderHariIni',
            'totalPenjualanBahanHariIni',
            'stokKritis',
            'chartData'
        ));
    }
}