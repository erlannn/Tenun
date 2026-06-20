<x-layout>
    <x-slot:title>Data Produk</x-slot:title>

    <!-- ========================================== -->
    <!-- 1. DATA DUMMY (Sesuai Gambar image_a41f62.png) -->
    <!-- ========================================== -->
    @php
        $dataProduk = [
            ['no' => 1, 'nama' => 'Baju', 'kategori' => 'Preorder', 'harga' => '500.000'],
            ['no' => 2, 'nama' => 'Selendang', 'kategori' => 'Preorder', 'harga' => '350.000'],
            ['no' => 3, 'nama' => 'Tas', 'kategori' => 'Preorder', 'harga' => '200.000'],
            ['no' => 4, 'nama' => 'Taplak Meja', 'kategori' => 'Preorder', 'harga' => '250.000'],
            ['no' => 5, 'nama' => 'Baju Pengantin', 'kategori' => 'Preorder', 'harga' => '2.000.000'],
        ];
    @endphp

    <!-- CONTAINER UTAMA (Dengan Shading Lembut) -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6">
        
        <!-- ========================================== -->
        <!-- 2. HEADER TABEL (Tombol Tambah & Search) -->
        <!-- ========================================== -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h3 class="text-xl font-bold text-gray-800">Data Produk</h3>
            
            <div class="flex items-center space-x-3 self-end sm:self-auto">
                <!-- Tombol Tambah Produk -->
                <button class="bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm px-4 py-2.5 rounded-lg flex items-center transition duration-200 cursor-pointer shadow-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Produk
                </button>

                <!-- Input Pencarian -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari Produk" class="w-64 pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400">
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 3. STRUKTUR TABEL DATA PRODUK -->
        <!-- ========================================== -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm font-bold text-gray-800 bg-gray-50/50">
                        <th class="py-3.5 px-4 w-16">No</th>
                        <th class="py-3.5 px-4">Nama Produk</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Harga</th>
                        <th class="py-3.5 px-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @foreach($dataProduk as $produk)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-4 font-medium text-gray-500">{{ $produk['no'] }}</td>
                        <td class="py-4 px-4 font-medium text-slate-700">{{ $produk['nama'] }}</td>
                        <td class="py-4 px-4 text-slate-500">{{ $produk['kategori'] }}</td>
                        <td class="py-4 px-4 font-medium text-gray-700">{{ $produk['harga'] }}</td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Tombol Edit (Hijau Lembut) -->
                                <button class="p-2 rounded-lg bg-[#E2F5E9] text-[#28A745] hover:bg-[#28A745] hover:text-white transition duration-200 cursor-pointer" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                <!-- Tombol Hapus (Merah Lembut) -->
                                <button class="p-2 rounded-lg bg-[#FCE8E6] text-[#DC3545] hover:bg-[#DC3545] hover:text-white transition duration-200 cursor-pointer" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ========================================== -->
        <!-- 4. NAVIGASI PAGINATION -->
        <!-- ========================================== -->
        <div class="flex justify-end mt-6">
            <nav class="inline-flex space-x-2 text-sm font-semibold">
                <button class="w-8 h-8 rounded bg-[#9BB1AA] text-white flex items-center justify-center cursor-pointer hover:bg-emerald-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                </button>
                <a href="#" class="w-8 h-8 rounded bg-[#004D39] text-white flex items-center justify-center shadow-sm">1</a>
                <a href="#" class="w-8 h-8 rounded border border-[#008080] text-[#008080] flex items-center justify-center hover:bg-teal-50 transition">2</a>
                <a href="#" class="w-8 h-8 rounded border border-[#008080] text-[#008080] flex items-center justify-center hover:bg-teal-50 transition">3</a>
                <span class="w-8 h-8 rounded border border-[#008080] text-[#008080] flex items-center justify-center">...</span>
                <button class="w-8 h-8 rounded bg-[#9BB1AA] text-white flex items-center justify-center cursor-pointer hover:bg-emerald-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>
            </nav>
        </div>

    </div>
</x-layout>