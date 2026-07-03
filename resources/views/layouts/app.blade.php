<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RiskaSulam') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/x-icon" href="{{ asset('Logo-Website.ico') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">
            {{-- Sidebar component --}}
            <aside class="w-64 bg-[#004D39] text-white flex flex-col min-h-screen sticky top-0 shadow-xl  md:flex z-20">
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
                    @role('Admin')
                    <a href="/transaksi-preorder" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('transaksi-preorder') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Transaksi Preorder
                    </a>
                    @endrole
                    <a href="/transaksi-bahan" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('transaksi-bahan') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Transaksi Bahan
                    </a>
                    @role('Admin')
                    <a href="/data-produk" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('data-produk*') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" /></svg>
                        Data Produk
                    </a>
                    <a href="/data-bahan" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm 
                    {{ request()->is('data-bahan') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                        Data Bahan
                    </a>
                    <a href="/laporan" class="flex items-center px-4 py-2.5 rounded-xl transition duration-200 font-medium text-sm {{ request()->is('laporan') ? 'bg-[#DDAE3B] text-[#004D39]' : 'text-gray-200 hover:bg-[#003628]' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" /></svg>
                        Laporan
                    </a>
                    @endrole
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
                {{-- <header class="bg-white border-b border-gray-200 px-4 py-2 flex items-center md:hidden">
                    <button id="sidebarToggle" class="text-gray-600 focus:outline-none mr-2">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </header> --}}
                <header class="bg-white border-b border-gray-200 px-4 py-2 flex items-center hidden md:flex">
                    <button id="sidebarToggleDesktop" class="flex items-center px-3 py-2 bg-[#004D39] text-white rounded hover:bg-[#003628]" aria-label="Toggle Sidebar"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
            <h2 class="ml-5 text-xl font-semibold text-gray-700">
        {{ $title ?? '' }}
    </h2>
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
