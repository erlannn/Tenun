<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\Bahan;
use App\Models\DetailBahan;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiPreorderController extends Controller
{
    private const JENIS_TRANSAKSI = Transaksi::JENIS_PREORDER;

    protected $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }
    /**
     * List all preorder transactions with status filters and search bar.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // all, diproses, selesai

        $query = Transaksi::with(['pelanggan', 'detailTransaksi.produk'])
              ->where('jenis_transaksi', self::JENIS_TRANSAKSI);

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
            'jumlah_bahan.*'    => 'nullable|integer|min:1',
        ]);

        $transaksi = DB::transaction(function () use ($validated) {
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
                'jenis_transaksi' => self::JENIS_TRANSAKSI,
                'status'          => Transaksi::STATUS_DIPROSES,
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
                    $idBahan = (int) $idBahan;
                    $qtyBahan = isset($validated['jumlah_bahan'][$idBahan]) ? (int) $validated['jumlah_bahan'][$idBahan] : 1;
                    $bahan = Bahan::find($idBahan);

                    if (!$bahan) {
                        throw new \RuntimeException('Bahan tidak ditemukan: ' . $idBahan);
                    }

                    if ($qtyBahan > (int) $bahan->stok) {
                        throw new \RuntimeException('Stok bahan ' . $bahan->nm_bahan . ' tidak mencukupi.');
                    }

                    DetailBahan::create([
                        'id_detail'    => $detailTrans->id_detail,
                        'id_bahan'     => $idBahan,
                        'jumlah_bahan' => $qtyBahan,
                    ]);

                    // Decrement stock
                    $bahan->decrement('stok', $qtyBahan);
                }
            }

            return $transaksi;
        });

        $waSent = false;
        $waError = null;

        if ($transaksi && $transaksi->pelanggan && $transaksi->pelanggan->no_hp) {
            try {
                $transaksi->load(['pelanggan', 'detailTransaksi.produk', 'detailTransaksi.detailBahan.bahan']);

                $totalProduk = $transaksi->detailTransaksi->reduce(function ($carry, $dt) {
                    return $carry + (($dt->produk->harga ?? 0) * $dt->jumlah);
                }, 0);

                $totalBahan = $transaksi->detailTransaksi->reduce(function ($carry, $dt) {
                    return $carry + $dt->detailBahan->reduce(function ($subtotal, $detailBahan) {
                        return $subtotal + (($detailBahan->bahan->harga ?? 0) * $detailBahan->jumlah_bahan);
                    }, 0);
                }, 0);

                $grandTotal = $totalProduk + $totalBahan;

                $messageLines = [];
                $messageLines[] = 'Hallo, ' . ($transaksi->pelanggan->nm_pelanggan ?? '-');
                $messageLines[] = '*Terima kasih sudah belanja di Riska sulam!*';
                $messageLines[] = 'Nomor HP: ' . ($transaksi->pelanggan->no_hp ?? '-');
                $messageLines[] = '';
                $tanggalPesan = $transaksi->tanggal_pesan instanceof \Carbon\Carbon
                    ? $transaksi->tanggal_pesan->format('d-m-Y')
                    : ($transaksi->tanggal_pesan ? date('d-m-Y', strtotime($transaksi->tanggal_pesan)) : '-');

                $tanggalSelesai = $transaksi->tanggal_selesai instanceof \Carbon\Carbon
                    ? $transaksi->tanggal_selesai->format('d-m-Y')
                    : ($transaksi->tanggal_selesai ? date('d-m-Y', strtotime($transaksi->tanggal_selesai)) : '-');

                $messageLines[] = 'Tanggal pesan: ' . $tanggalPesan;
                $messageLines[] = 'Estimasi selesai ' . $tanggalSelesai;
                $messageLines[] = '';
                $messageLines[] = '*Produk yang di order*:';

                foreach ($transaksi->detailTransaksi as $detailTransaksi) {
                    $namaProduk = $detailTransaksi->produk->nm_produk ?? '-';
                    $hargaProduk = (int) ($detailTransaksi->produk->harga ?? 0);
                    $jumlahProduk = (int) $detailTransaksi->jumlah;
                    $totalProdukItem = $hargaProduk * $jumlahProduk;
                    $messageLines[] = '- ' . $namaProduk;
                    $messageLines[] = '  Harga produk: Rp ' . number_format($hargaProduk, 0, ',', '.');
                    $messageLines[] = '  Jumlah item: ' . $jumlahProduk;
                    $messageLines[] = '  Total: Rp ' . number_format($totalProdukItem, 0, ',', '.');
                    $messageLines[] = '  ';

                    if ($detailTransaksi->detailBahan->isNotEmpty()) {
                        $messageLines[] = '*Bahan yang digunakan*:';

                        foreach ($detailTransaksi->detailBahan as $detailBahan) {
                            $namaBahan = $detailBahan->bahan->nm_bahan ?? '-';
                            $hargaSatuan = (int) ($detailBahan->bahan->harga ?? 0);
                            $jumlahBahan = (int) $detailBahan->jumlah_bahan;
                            $totalBahanItem = $hargaSatuan * $jumlahBahan;

                            $messageLines[] = '  - ' . $namaBahan;
                            $messageLines[] = '    Harga satuan: Rp ' . number_format($hargaSatuan, 0, ',', '.');
                            $messageLines[] = '    Jumlah item: ' . $jumlahBahan;
                            $messageLines[] = '    Total: Rp ' . number_format($totalBahanItem, 0, ',', '.');
                        }
                    }
                }

                $messageLines[] = ' ';
                $messageLines[] = '*Total pembayaran: Rp ' . number_format($grandTotal, 0, ',', '.') . '*';

                $message = implode("\n", $messageLines);

                logger()->info('Sending preorder summary to WhatsApp', [
                    'transaksi_id' => $transaksi->id_transaksi,
                    'message_length' => strlen($message),
                ]);

                $response = $this->whatsappService->sendMessage($transaksi->pelanggan->no_hp, $message);

                logger()->info('Fonnte response detail', $response);

                if (isset($response['status']) && $response['status'] == true) {
                    $waSent = true;
                } else {
                    $waError = $response['reason'] ?? 'Gagal mengirim pesan WhatsApp ke Fonnte';
                    logger()->warning('WhatsApp notification send failed', [
                        'transaksi_id' => $transaksi->id_transaksi,
                        'response' => $response,
                    ]);
                }
            } catch (\Throwable $e) {
                logger()->error('Gagal mengirim WhatsApp preorder: ' . $e->getMessage());
                $waError = $e->getMessage();
            }
        }

        if ($waSent) {
            return redirect()->route('transaksi-preorder')->with('success', 'Transaksi preorder berhasil disimpan dan struk berhasil dikirim ke WhatsApp!');
        } elseif ($waError) {
            return redirect()->route('transaksi-preorder')->with('success', 'Transaksi preorder berhasil disimpan, tetapi gagal mengirim WhatsApp: ' . $waError);
        }

        return redirect()->route('transaksi-preorder')->with('success', 'Transaksi preorder berhasil disimpan!');
    }

    /**
     * Update preorder transaction status.
     */
    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::where('jenis_transaksi', self::JENIS_TRANSAKSI)->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:' . Transaksi::STATUS_DIPROSES . ',' . Transaksi::STATUS_SELESAI,
        ]);

        $transaksi->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('transaksi-preorder')->with('success', 'Status preorder berhasil diperbarui!');
    }
}
