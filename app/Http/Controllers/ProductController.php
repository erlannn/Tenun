<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Eager load relasi kategori
        $produk = Produk::with('kategori')
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                // Mencari berdasarkan nama produk
                $query->where('nm_produk', 'like', "%{$search}%")
                // Mencari berdasarkan nama kategori di tabel kategori
                      ->orWhereHas('kategori', function ($queryKategori) use ($search) {
                          $queryKategori->where('nm_kategori', 'like', "%{$search}%");
                      });
            });
        })
        ->orderBy('id_produk', 'desc') 
        ->paginate(5)
        ->withQueryString();

        return view('produk.data-produk', compact('produk', 'search'));
    }

    public function welcome(Request $request)
    {
        $search = $request->input('search');

        $katalogProduk =Produk::with('kategori')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('nm_produk', 'like', "%{$search}%")
                          ->orWhereHas('kategori', function ($queryKategori) use ($search) {
                              $queryKategori->where('nm_kategori', 'like', "%{$search}%");
                          });
                });
            })
            ->orderBy('id_produk', 'desc') 
            ->paginate(5)
            ->withQueryString(); 

        return view('welcome', compact('katalogProduk', 'search'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nm_kategori', 'asc')->get();
        
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nm_produk'   => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori', 
            'harga'       => 'required|numeric',
            'foto'        => 'nullable|image|mimes:png|max:2048', 
        ]);

        // Proses upload foto
        if ($request->hasFile('foto')) {
            // 1. Buat nama unik untuk foto (contoh hasil: 1719400000.png)
            $fotoName = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            
            // 2. Pindahkan file fisik foto ke folder public/images/produk
            $request->file('foto')->move(public_path('images/produk'), $fotoName);
            
            // 3. Simpan HANYA NAMA FOTONYA saja ke database
            $validated['foto'] = $fotoName;
        }

        Produk::create($validated);

        return redirect()->route('data-produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $kategori = Kategori::orderBy('nm_kategori', 'asc')->get();
        
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nm_produk' => 'required|string|max:255',
            'id_kategori' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $produk->update($validated);
        return redirect()->route('data-produk')->with('success', 'Produk updated.');
    }

    public function destroy($produk)
    {
        $produk = Produk::findOrFail($produk);
        $produk->delete();
        return redirect()->route('data-produk')->with('success', 'Produk berhasil dihapus.');
    }
}