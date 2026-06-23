<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">
            {{-- Sidebar component --}}
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

                <!-- Navigation Links -->
                <nav class="flex-1 p-4 space-y-3 mt-6">
                    <a href="/dashboard" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('dashboard') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm text-gray-200 hover:bg-[#003628]">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Transaksi Preorder
                    </a>
                    <a href="/transaksi-bahan" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('transaksi-bahan*') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Transaksi Bahan
                    </a>
                    <a href="data-produk" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('data-produk*') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Data Produk
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm text-gray-200 hover:bg-[#003628]">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 0 012-2m0 0V5a2 0 012-2h6a2 0 012 2v2M7 7h10"/></svg>
                        Data Bahan
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm text-gray-200 hover:bg-[#003628]">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 0 002-2v-4a2 0 00-2-2H5a2 0 00-2 2v4a2 0 002 2h2m2 4h6a2 0 002-2v-4a2 0 00-2-2H9a2 0 00-2 2v4a2 0 002 2zm8-12V5a2 0 00-2-2H9a2 0 00-2 2v4h10z"/></svg>
                        Laporan
                    </a>
                </nav>
                <!-- Logout Button -->
                <div class="text-center text-white py-1 mb-2">
                    <div class="text-sm font-semibold text-slate-200">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-300">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-auto bg-[#DDAE3B]">
                    <form method="POST" action="/logout" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-10 py-5 text-white font-medium text-sm transition duration-200 hover:bg-[#C49A2D] cursor-pointer text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>
            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col">
                <!-- Top Bar for Mobile (Hamburger) -->
                <header class="bg-white border-b border-gray-200 px-4 py-2 flex items-center md:hidden">
                    <button id="sidebarToggle" class="text-gray-600 focus:outline-none mr-2">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>


                    
                </header>
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
                <!-- Desktop Navbar with Sidebar Toggle -->
                <header class="bg-white border-b border-gray-200 px-4 py-2 flex items-center hidden md:flex">
                    <button id="sidebarToggleDesktop" class="flex items-center px-3 py-2 bg-[#004D39] text-white rounded hover:bg-[#003628]" aria-label="Toggle Sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </header>
                <main class="flex-1 p-8 bg-white overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        const sidebar = document.querySelector('aside');
        if (sidebar) {
            // Mobile toggle (hidden/unhidden)
            sidebar.classList.toggle('hidden');
        }
    });
    // Desktop toggle button (visible on md+ screens)
    document.getElementById('sidebarToggleDesktop')?.addEventListener('click', function () {
        const sidebar = document.querySelector('aside');
        if (sidebar) {
            // Toggle both hidden and md:hidden to affect desktop view
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('md:hidden');
        }
    });
</script>
    </body>
</html>
