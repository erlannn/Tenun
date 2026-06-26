<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Riska Sulam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF6E9]/40 font-sans antialiased text-gray-800">

    <!-- ========================================== -->
    <!-- 1. DATA DUMMY PRODUK KATALOG               -->
    <!-- ========================================== -->
    @php
        // NOTE FOR BACKEND: Hapus blok @php ini jika data sudah dilempar dari Controller.
        $katalogProduk = [
            ['nama' => 'Baju Kurung Sulam Koto Gadang', 'kategori' => 'Baju', 'harga' => '1.500.000', 'status' => 'Preorder', 'foto' => 'images/produk/baju-kurung.jpg'],
            ['nama' => 'Selendang Sulam Bayang Premium', 'kategori' => 'Selendang', 'harga' => '350.000', 'status' => 'Ready Stok', 'foto' => 'images/produk/selendang.jpg'],
            ['nama' => 'Tas Jinjing Motif Sulam Pita', 'kategori' => 'Tas', 'harga' => '200.000', 'status' => 'Ready Stok', 'foto' => 'images/produk/tas.jpg'],
            ['nama' => 'Taplak Meja Sulam Suji Cair', 'kategori' => 'Taplak Meja', 'harga' => '250.000', 'status' => 'Preorder', 'foto' => 'images/produk/taplak.jpg'],
            ['nama' => 'Baju Pengantin Minang Klasik', 'kategori' => 'Baju', 'harga' => '3.500.000', 'status' => 'Preorder', 'foto' => 'images/produk/pengantin.jpg'],
            ['nama' => 'Mukena Sulam Kepala Bukittinggi', 'kategori' => 'Mukena', 'harga' => '650.000', 'status' => 'Ready Stok', 'foto' => 'images/produk/mukena.jpg'],
        ];
    @endphp

    <!-- NAVBAR / HEADER ATAS -->
    <nav class="bg-[#004D39] text-white px-6 py-4 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-[#DDAE3B] rounded-lg flex items-center justify-center font-bold text-[#004D39]">RS</div>
                <span class="text-xl font-bold tracking-wide">Riska Sulam</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="#" class="text-[#DDAE3B] font-semibold border-b-2 border-[#DDAE3B] pb-1 text-sm">Katalog Produk</a>
                <a href="/login" class="bg-[#DDAE3B] hover:bg-[#C49A2D] text-[#004D39] font-bold text-xs px-4 py-2 rounded-lg transition duration-200 shadow-sm">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (BANNER UTAMA) -->
    <header class="bg-[#004D39] text-white py-16 px-6 text-center relative overflow-hidden border-b border-[#DDAE3B]/20">
        <div class="max-w-3xl mx-auto relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4">Koleksi Sulaman Tradisional Minang</h1>
            <p class="text-gray-200 text-sm md:text-base mb-8">Temukan keindahan seni sulam tangan autentik berkualitas premium untuk menyempurnakan momen berharga Anda.</p>
            <div class="max-w-md mx-auto relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" placeholder="Cari produk impian Anda..." class="w-full pl-10 pr-4 py-3 bg-white text-gray-800 border-none rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#DDAE3B] shadow-lg transition">
            </div>
        </div>
    </header>

    <!-- GRID KATALOG PRODUK -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-[#001A12]">Daftar Produk Pilihan</h2>
            <span class="text-xs text-gray-500 font-medium bg-white px-3 py-1.5 rounded-full border border-gray-200">Menampilkan {{ count($katalogProduk) }} Produk</span>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($katalogProduk as $produk)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- AREA FOTO PRODUK -->
                    <div class="h-56 bg-[#FAF6E9] relative border-b border-gray-100 overflow-hidden">
                        <img src="{{ asset($produk['foto']) }}" alt="{{ $produk['nama'] }}" class="w-full h-full object-cover">
                        
                        <!-- Badge Status -->
                        <span class="absolute top-4 left-4 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm 
                            {{ $produk['status'] == 'Preorder' ? 'bg-[#FAF6E9] text-[#DDAE3B] border border-[#DDAE3B]/40' : 'bg-[#E2F5E9] text-[#28A745]' }}">
                            {{ $produk['status'] }}
                        </span>
                    </div>

                    <!-- Detail Info Produk -->
                    <div class="p-5">
                        <span class="text-xs font-bold text-[#DDAE3B] tracking-wider uppercase">{{ $produk['kategori'] }}</span>
                        <h3 class="text-base font-bold text-gray-900 mt-1 line-clamp-2 h-12">{{ $produk['nama'] }}</h3>
                        <p class="text-lg font-extrabold text-[#004D39] mt-2">Rp {{ $produk['harga'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-[#001A12] text-gray-400 py-8 px-6 text-center border-t border-gray-900 mt-20 text-xs">
        <p>&copy; 2026 Riska Sulam - Bukittinggi. All Rights Reserved.</p>
    </footer>

</body>
</html>