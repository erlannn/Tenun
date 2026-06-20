<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riska Sulam - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-white font-sans min-h-screen flex m-0 p-0 overflow-x-hidden">

    <!-- SIDEBAR (Warna Hijau Tua Premium Minang) -->
    <aside class="w-64 bg-[#004D39] text-white flex flex-col min-h-screen sticky top-0 shadow-xl hidden md:flex z-20">
        <!-- Brand Area -->
        <div class="pt-8 px-6 text-center">
            <div class="flex items-center space-x-3 justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Riska Sulam" class="w-14 h-14 object-contain">
                <div class="text-left">
                    <h1 class="font-serif font-bold text-xl tracking-wider text-white leading-none">RISKA</h1>
                    <span class="font-serif font-medium text-xs tracking-widest text-[#D4AF37] mt-1 block">Sulam</span>
                </div>
            </div>
            <!-- Garis Emas Horizontal Tipis -->
            <div class="border-b border-[#D4AF37] w-full opacity-60"></div>
        </div>

        <!-- Menu Navigasi dengan Ikon Garis Sesuai Gambar Figma -->
        <nav class="flex-1 p-4 space-y-3 mt-6">
            
            <!-- Dashboard (Aktif: Background Emas Muted, Teks Hijau Tua) -->
           <a href="/dashboard" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm 
        {{ request()->is('dashboard') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>

            <!-- Transaksi Preorder -->
           <a href="#" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm text-gray-200 hover:bg-[#003628]">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                 Transaksi Preorder
         </a>

            <!-- Transaksi Bahan -->
           <a href="/transaksi-bahan" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm 
        {{ request()->is('transaksi-bahan*') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Transaksi Bahan
    </a>

            <!-- Data Produk --> 
            <a href="data-produk" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('data-produk*') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Data Produk
            </a>

            <!-- Data Bahan belum disesuaikan untuk navbar aktif--> 
            <a href="#" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm text-gray-200 hover:bg-[#003628]">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Data Bahan
            </a>

            <!-- Laporan belum disesuaikan untuk navbar aktif --> 
            <a href="#" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm text-gray-200 hover:bg-[#003628]">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Laporan
            </a>

        </nav>

        <!-- ... batas akhir tag </nav> ... -->
        </nav>

        <!-- ================= -->
        <!-- TOMBOL KELUAR  -->
        <!-- ================= -->
        <div class="mt-auto bg-[#DDAE3B]">
            <form method="POST" action="/logout" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center px-10 py-5 text-white font-medium text-sm transition duration-200 hover:bg-[#C49A2D] cursor-pointer text-left">
                    <!-- Ikon Pintu Keluar  -->
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside> <!-- Batas Akhir Sidebar -->
    

    <!-- CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- TOPBAR (Latar Krem Lembut Sesuai Gambar) -->
        <header class="bg-[#FAF6E9] px-8 py-5 flex items-center border-b border-gray-100 shadow-sm sticky top-0y">
            <!-- Ikon Hamburger -->
            <button class="text-gray-600 mr-4 focus:outline-none flex items-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight font-sans">{{ $title }}</h2>
        </header>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 p-8 bg-white overflow-y-auto">
            {{ $slot }}
        </main>

    </div>

</body>
</html>