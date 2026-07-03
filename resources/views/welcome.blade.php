<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Riska Sulam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF6E9]/40 font-sans antialiased text-gray-800">

    <nav class="bg-[#004D39] text-white px-6 py-4 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-[#DDAE3B] rounded-lg flex items-center justify-center font-bold text-[#004D39]">RS</div>
                <span class="text-xl font-bold tracking-wide">Riska Sulam</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="/login" class="bg-[#DDAE3B] hover:bg-[#C49A2D] text-[#004D39] font-bold text-xs px-4 py-2 rounded-lg transition duration-200 shadow-sm">Masuk</a>
            </div>
        </div>
    </nav>

    <header class="bg-[#004D39] text-white py-16 px-6 text-center relative overflow-hidden border-b border-[#DDAE3B]/20">
        <div class="max-w-3xl mx-auto relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4">Koleksi Sulaman Tradisional Minang</h1>
            <p class="text-gray-200 text-sm md:text-base mb-8">Temukan keindahan seni sulam tangan autentik berkualitas premium untuk menyempurnakan momen berharga Anda.</p>
            <div class="max-w-md mx-auto relative">
                <form method="GET" action="{{ route('welcome') }}">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari produk" class="w-full pl-10 pr-4 py-3 bg-white text-gray-800 border-none rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#DDAE3B] shadow-lg transition">
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-[#001A12]">Daftar Produk Pilihan</h2>
            <span class="text-xs text-gray-500 font-medium bg-white px-3 py-1.5 rounded-full border border-gray-200">
                Menampilkan {{ $katalogProduk->count() }} Produk
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($katalogProduk as $produk)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="h-56 bg-[#FAF6E9] relative border-b border-gray-100 overflow-hidden">
                        @if($produk->foto)
                            <img src="{{ asset('images/produk/' . $produk->foto) }}" alt="{{ $produk->nm_produk }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/sample/' . $produk->foto) }}" alt="{{ $produk->nm_produk }}" class="w-full h-full object-cover">
                        @endif
                        
                        <span class="absolute top-4 left-4 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm 
                            {{ $produk->harga >= 1000000 ? 'bg-[#FAF6E9] text-[#DDAE3B] border border-[#DDAE3B]/40' : 'bg-[#E2F5E9] text-[#28A745]' }}">
                            {{ $produk->harga >= 1000000 ? 'Preorder' : 'Ready Stok' }}
                        </span>
                    </div>

                    <div class="p-5">
                        <span class="text-xs font-bold text-[#DDAE3B] tracking-wider uppercase">
                            {{ $produk->kategori->nm_kategori ?? 'Kategori Umum' }}
                        </span>
                        
                        <h3 class="text-base font-bold text-gray-900 mt-1 line-clamp-2 h-12">{{ $produk->nm_produk }}</h3>
                        
                        <p class="text-lg font-extrabold text-[#004D39] mt-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Belum ada produk yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-20">
            {{ $katalogProduk->links() }}
        </div>
    </main>

    <footer class="bg-[#001A12] text-gray-400 py-8 px-6 text-center border-t border-gray-900 mt-20 text-xs">
        <p>&copy; 2026 Riska Sulam - Bukittinggi. All Rights Reserved.</p>
    </footer>

</body>
</html>