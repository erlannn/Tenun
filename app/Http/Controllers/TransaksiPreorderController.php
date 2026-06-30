<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\Bahan;
use App\Models\DetailBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiPreorderController extends Controller
{
    /**
     * List all preorder transactions with status filters and search bar.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // all, diproses, selesai

        $query = Transaksi::with(['pelanggan', 'detailTransaksi.produk'])
            ->where('jenis_transaksi', 'PreOrder');

        // Apply status filter
        if ($status === 'diproses' || $status === 'selesai') {
            $query->where('status', $status);
        }

        // Apply search filter (customer name)
        if ($search) {
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nm_pelanggan', 'like', "%{$search}%");
            });
        }

        $paginator = $query->orderBy('id_transaksi', 'desc')
            ->paginate(5)
            ->appends(['search' => $search, 'status' => $status]);

        // Transform items for the view
        $preorders = $paginator->getCollection()->map(function ($tr) {
            $productNames = $tr->detailTransaksi->map(function ($dt) {
                return $dt->produk ? $dt->produk->nm_produk . " (" . $dt->jumlah . ")" : 'Unknown Product';
            })->implode(', ');

            $motifs = $tr->detailTransaksi->map(function ($dt) {
                return $dt->motif;
            })->filter()->implode(', ');

            // Calculate total price: sum of (produk.harga * jumlah)
            $total = $tr->detailTransaksi->reduce(function ($carry, $dt) {
                return $carry + (($dt->produk->harga ?? 0) * $dt->jumlah);
            }, 0);

            return (object)[
                'id' => $tr->id_transaksi,
                'no' => $tr->id_transaksi,
                'tanggal_pesan' => $tr->tanggal_pesan,
                'tanggal_selesai' => $tr->tanggal_selesai,
                'nama' => $tr->pelanggan->nm_pelanggan ?? 'Unknown',
                'produk' => $productNames,
                'motif' => $motifs ?: '-',
                'total' => $total,
                'status' => $tr->status,
            ];
        });

        $paginator->setCollection($preorders);

        return view('preorder.transaksi-preorder', [
            'preorder' => $paginator,
            'search' => $search,
            'status' => $status ?: 'semua',
        ]);
    }

    /**
     * Show form to create a new preorder.
     */
    public function create()
    {
        $produk = Produk::orderBy('nm_produk')->get();
        $bahan = Bahan::with('satuan')->orderBy('nm_bahan')->get();
        return view('preorder.create', compact('produk', 'bahan'));
    }

    /**
     * Store a new preorder transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:100',
            'no_hp'             => 'nullable|string|max:15',
            'id_produk'         => 'required|exists:produk,id_produk',
            'motif'             => 'nullable|string|max:255',
            'jumlah'            => 'required|integer|min:1',
            'perkiraan_selesai' => 'nullable|date',
            'bahan'             => 'nullable|array',
            'bahan.*'           => 'exists:bahan,id_bahan',
            'jumlah_bahan'      => 'nullable|array',
        ]);

        DB::transaction(function () use ($validated) {
            // Find or create customer
            $pelanggan = Pelanggan::firstOrCreate(
                ['nm_pelanggan' => $validated['nama']],
                ['no_hp' => $validated['no_hp']]
            );

            // Create Preorder transaction
            $transaksi = Transaksi::create([
                'id_pelanggan'    => $pelanggan->id_pelanggan,
                'tanggal_pesan'   => now()->format('Y-m-d'),
                'tanggal_selesai' => $validated['perkiraan_selesai'] ?: null,
                'jenis_transaksi' => 'PreOrder',
                'status'          => 'diproses',
            ]);

            // Create DetailTransaksi
            $detailTrans = DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk'    => $validated['id_produk'],
                'jumlah'       => $validated['jumlah'],
                'motif'        => $validated['motif'] ?: null,
            ]);

            // Handle materials used
            if (!empty($validated['bahan'])) {
                foreach ($validated['bahan'] as $idBahan) {
                    $qtyBahan = isset($validated['jumlah_bahan'][$idBahan]) ? (int) $validated['jumlah_bahan'][$idBahan] : 1;

                    DetailBahan::create([
                        'id_detail'    => $detailTrans->id_detail,
                        'id_bahan'     => $idBahan,
                        'jumlah_bahan' => $qtyBahan,
                    ]);

                    // Decrement stock
                    $bahan = Bahan::find($idBahan);
                    if ($bahan) {
                        $bahan->decrement('stok', $qtyBahan);
                    }
                }
            }
        });

        return redirect()->route('transaksi-preorder')->with('success', 'Transaksi preorder berhasil disimpan!');
    }

    /**
     * Update preorder transaction status.
     */
    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::where('jenis_transaksi', 'PreOrder')->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:diproses,selesai',
        ]);

        $transaksi->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('transaksi-preorder')->with('success', 'Status preorder berhasil diperbarui!');
    }
}
