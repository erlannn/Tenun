<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\DetailBahan;
use App\Models\Bahan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiBahanController extends Controller
{
    /**
     * List all transaksi bahan.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $paginator = Transaksi::with(['pelanggan', 'detailTransaksi.detailBahan.bahan'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('pelanggan', fn($qq) => $qq->where('nm_pelanggan', 'like', "%{$search}%"))
                  ->orWhere('tanggal_pesan', 'like', "%{$search}%");
            })
            ->orderBy('id_transaksi', 'desc')
            ->paginate(5)
            ->appends(['search' => $search]);

        // Transform paginated items for view convenience
        $transaksiBahan = $paginator->getCollection()->map(function ($tr) {
            $detailNames = $tr->detailTransaksi->map(function ($dt) {
                return $dt->detailBahan->map(function ($db) {
                    return $db->bahan->nm_bahan . " (" . $db->jumlah_bahan . ")";
                })->implode(', ');
            })->implode(', ');
            $total = $tr->detailTransaksi->reduce(function ($carry, $dt) {
                return $carry + ($dt->detailBahan->first()?->bahan->harga ?? 0) * $dt->detailBahan->first()?->jumlah_bahan;
            }, 0);
            return (object)[
                'id' => $tr->id_transaksi,
                'no' => $tr->id_transaksi,
                'tanggal' => $tr->tanggal_pesan,
                'nama' => $tr->pelanggan->nm_pelanggan ?? 'Unknown',
                'detail' => $detailNames,
                'jumlah' => $tr->detailTransaksi->sum('jumlah'),
                'total' => number_format($total, 0, ',', '.'),
            ];
        });

        // Attach transformed collection back to paginator
        $paginator->setCollection($transaksiBahan);


        return view('transaksi-bahan.transaksi-bahan', [
            'transaksiBahan' => $paginator,
            'search' => $search,
        ]);
    }

    /**
     * Show the form to create a new transaksi.
     */
    public function create()
    {
        $bahan = Bahan::with('satuan')->orderBy('nm_bahan')->get();

        if (empty(session('transaksi_bahan_cart', []))) {
            session()->forget('nama_pelanggan');
        }

        return view('transaksi-bahan.create', compact('bahan'));
    }

    /**
     * Store a new transaksi with its detail records.
     */
            public function store(Request $request)
    {
        $action = $request->input('action');
        // Handle adding an item to the cart
        if ($action === 'add') {
            $validated = $request->validate([
                'id_bahan' => 'required|exists:bahan,id_bahan',
                'jumlah'   => 'required|integer|min:1',
            ]);
            // Preserve customer name across adds
            $validated['nama_pelanggan'] = $request->input('nama_pelanggan');
            if ($validated['nama_pelanggan']) {
                session(['nama_pelanggan' => $validated['nama_pelanggan']]);
            }

            $bahan = Bahan::where('id_bahan', '=', $validated['id_bahan'], 'and')->first();
            $cart = session()->get('transaksi_bahan_cart', []);
            $cart[] = [
                'id'    => $bahan->id_bahan,
                'nama'  => $bahan->nm_bahan,
                'satuan'=> optional($bahan->satuan)->nm_satuan ?? '',
                'harga' => $bahan->harga,
                'jumlah'=> $validated['jumlah'],
            ];
            session(['transaksi_bahan_cart' => $cart]);

            return redirect()->route('transaksi-bahan.create')->with('success', 'Bahan ditambahkan ke keranjang.');
        }

        // Handle removing an item from the cart
        if ($action === 'remove') {
            $index = (int) $request->input('index');
            $cart = session()->get('transaksi_bahan_cart', []);
            if (array_key_exists($index, $cart)) {
                unset($cart[$index]);
                $cart = array_values($cart);
                session(['transaksi_bahan_cart' => $cart]);
            }
            return redirect()->route('transaksi-bahan.create');
            }

            if ($action === 'checkout') {
                $validated = $request->validate([
                    'nama_pelanggan' => 'required|string|max:255',
                ]);

                $cart = session()->get('transaksi_bahan_cart', []);
                if (empty($cart)) {
                    return redirect()->route('transaksi-bahan.create')->with('error', 'Keranjang kosong!');
                }

                DB::transaction(function () use ($validated, $cart) {
                    $pelanggan = Pelanggan::firstOrCreate(['nm_pelanggan' => $validated['nama_pelanggan']]);

                    $transaksi = Transaksi::create([
                        'id_pelanggan'    => $pelanggan->id_pelanggan,
                        'tanggal_pesan'   => now()->format('Y-m-d'),
                        'jenis_transaksi' => 'bahan',
                    ]);

                    foreach ($cart as $item) {
                        $detailTrans = DetailTransaksi::create([
                            'id_transaksi' => $transaksi->id_transaksi,
                            'id_produk'    => $item['id'],
                            'jumlah'       => $item['jumlah'],
                            'motif'        => null,
                        ]);

                        DetailBahan::create([
                            'id_detail'    => $detailTrans->id_detail,
                            'id_bahan'     => $item['id'],
                            'jumlah_bahan' => $item['jumlah'],
                        ]);
                        // Decrease stock
                        $bahan = Bahan::where('id_bahan', '=', $item['id'], 'and')->first();
                        if ($bahan) {
                            $bahan->decrement('stok', $item['jumlah']);
                        }
                    }
                });

                session()->forget('transaksi_bahan_cart');
                session()->forget('nama_pelanggan');
                return redirect()->route('transaksi-bahan')->with('success', 'Transaksi berhasil disimpan!');
            }

            $validated = $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
            ]);

            $cart = session()->get('transaksi_bahan_cart', []);
            if (empty($cart)) {
                return redirect()->route('transaksi-bahan')->with('error', 'Keranjang kosong!');
            }

            DB::transaction(function () use ($validated, $cart) {
                $pelanggan = Pelanggan::firstOrCreate(['nm_pelanggan' => $validated['nama_pelanggan']]);

                $transaksi = Transaksi::create([
                    'id_pelanggan'    => $pelanggan->id_pelanggan,
                    'tanggal_pesan'   => now()->format('Y-m-d'),
                    'jenis_transaksi' => 'bahan',
                ]);

                foreach ($cart as $item) {
                    $detailTrans = DetailTransaksi::create([
                        'id_transaksi' => $transaksi->id_transaksi,
                        'jumlah'       => $item['jumlah'],
                        'motif'        => null,
                    ]);

                    DetailBahan::create([
                        'id_detail'    => $detailTrans->id_detail,
                        'id_bahan'     => $item['id'],
                        'jumlah_bahan' => $item['jumlah'],
                    ]);
                }
            });

            session()->forget('transaksi_bahan_cart');
                session()->forget('nama_pelanggan');
            return redirect()->route('transaksi-bahan')->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Show detail of a single transaksi.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'detailTransaksi.detailBahan.bahan'])
            ->findOrFail($id);

        // Build a simple collection for the view
        $items = $transaksi->detailTransaksi->map(function ($dt) {
            $b = $dt->detailBahan->first();
            $bahan = $b->bahan ?? null;
            return (object)[
                'nama'   => $bahan->nm_bahan ?? 'Unknown',
                'qty'    => $b->jumlah_bahan ?? 0,
                'harga'  => $bahan->harga ?? 0,
                'subtotal'=> ($bahan->harga ?? 0) * ($b->jumlah_bahan ?? 0),
            ];
        });

        $total = $items->sum('subtotal');

        return view('transaksi-bahan.detail', [
            'transaksi' => $transaksi,
            'items'     => $items,
            'total'     => number_format($total, 0, ',', '.'),
        ]);
    }
}
