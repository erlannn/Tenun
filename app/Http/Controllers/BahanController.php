<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $bahan =Bahan::with('satuan')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('nm_bahan', 'like', "%{$search}%")
                          ->orWhereHas('satuan', function ($querySatuan) use ($search) {
                              $querySatuan->where('nm_satuan', 'like', "%{$search}%");
                          });
                });
            })
            ->orderBy('id_bahan', 'desc') 
            ->paginate(5)
            ->withQueryString(); 

        $bahan->getCollection()->transform(function ($item) {
            $item->harga_satuan = $item->harga; 
            return $item;
        });

        return view('bahan.data-bahan', compact('bahan', 'search'));
    }

    public function create()
    {
        $satuan = Satuan::orderBy('nm_satuan', 'asc')->get();

        return view('bahan.create', compact('satuan')); // Sesuaikan dengan nama file form tambah kamu
    }

    /**
     * Menyimpan bahan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_bahan' => 'required|string|max:255',
            'id_satuan' => 'required|exists:satuan,id_satuan', 
            'harga'    => 'required|numeric|min:0',
            'stok'     => 'required|integer|min:0',
        ]);

        Bahan::create($request->all());

        return redirect()->route('data-bahan')->with('success', 'Bahan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit untuk bahan tertentu.
     */
    public function edit(Bahan $bahan)
    {
        $satuan = Satuan::orderBy('nm_satuan', 'asc')->get();
        return view('bahan.edit', compact('bahan', 'satuan')); // Sesuaikan dengan nama file form edit kamu
    }

    /**
     * Memperbarui data bahan di database.
     */
    public function update(Request $request, Bahan $bahan)
    {
        $request->validate([
            'nm_bahan' => 'required|string|max:255',
            'id_satuan' => 'required|exists:satuan,id_satuan', 
            'harga'    => 'required|numeric|min:0',
            'stok'     => 'required|integer|min:0',
        ]);

        $bahan->update($request->all());

        return redirect()->route('data-bahan')->with('success', 'Bahan berhasil diperbarui!');
    }

    /**
     * Menghapus data bahan dari database.
     */
    public function destroy($bahan)
    {
        $bahan = Bahan::findOrFail($bahan);
        
        // if ($bahan->detailBahan()->exists()) {
        //     return redirect()->route('data-bahan')->with('error', 'Bahan tidak dapat dihapus karena masih digunakan di detail_bahan!');
        // }
        $bahan->delete();
        return redirect()->route('data-bahan')->with('success', 'Bahan berhasil dihapus!');
    }
}