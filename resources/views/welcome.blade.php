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
                            <button type="button" class="catalog-image-trigger block w-full h-full overflow-hidden" data-image-src="{{ asset('images/produk/' . $produk->foto) }}" aria-label="Lihat foto {{ $produk->nm_produk }}">
                                <img src="{{ asset('images/produk/' . $produk->foto) }}" alt="{{ $produk->nm_produk }}" class="w-full h-full object-cover cursor-zoom-in transition duration-300 ease-out hover:scale-105">
                            </button>
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

    <div id="catalogImageModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 p-4" role="dialog" aria-modal="true" aria-label="Pratinjau foto produk">
        <div class="relative w-full max-w-5xl">
            <button id="catalogImageModalClose" type="button" class="absolute -top-12 right-0 text-white text-3xl font-semibold hover:text-[#DDAE3B] transition" aria-label="Tutup foto">
                &times;
            </button>
            <img id="catalogImageModalImg" src="" alt="Foto produk penuh" class="w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl">
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6282287939685?text=Halo%20Admin%20Riska%20Sulam,%20saya%20ingin%20bertanya%20mengenai%20produk" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="fixed bottom-6 right-6 z-50 flex items-center space-x-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-4 py-3 rounded-full shadow-2xl transition duration-300 transform hover:scale-105 group border border-white/20"
       aria-label="Hubungi Admin via WhatsApp">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="text-xs font-bold tracking-wide">Hubungi Admin</span>
    </a>

    <footer class="bg-[#001A12] text-gray-400 py-8 px-6 text-center border-t border-gray-900 mt-20 text-xs">
        <p>&copy; 2026 Riska Sulam - Bukittinggi. All Rights Reserved.</p>
    </footer>

</body>
</html>