<x-layout>
    <x-slot:title>Transaksi Bahan</x-slot:title>

    <!-- ========================================== -->
    <!-- 1. DATA DUMMY (Sesuai Gambar image_aeadf6.png) -->
    <!-- ========================================== -->
    @php
        // Backend tinggal menghapus blok @php ini dan mengirimkan data asli lewat paginator Laravel
        $transaksiBahan = [
            ['no' => 1, 'tanggal' => '05-06-2026', 'nama' => 'Delyn', 'detail' => 'Kain Satin, Benang Emas, Manik-Manik', 'jumlah' => 4, 'total' => '300.000', 'status' => 'Selesai'],
            ['no' => 2, 'tanggal' => '05-06-2026', 'nama' => 'indira', 'detail' => 'Kain Satin', 'jumlah' => 5, 'total' => '400.000', 'status' => 'Selesai'],
            ['no' => 3, 'tanggal' => '05-06-2026', 'nama' => 'Zee', 'detail' => 'Benang Emas', 'jumlah' => 2, 'total' => '60.000', 'status' => 'Selesai'],
            ['no' => 4, 'tanggal' => '04-06-2026', 'nama' => 'Isfa', 'detail' => 'Manik-Manik', 'jumlah' => 1, 'total' => '30.000', 'status' => 'Selesai'],
            ['no' => 5, 'tanggal' => '04-06-2026', 'nama' => 'Oline', 'detail' => 'Benang Emas', 'jumlah' => 4, 'total' => '120.000', 'status' => 'Selesai'],
        ];
    @endphp

    <!-- CONTAINER UTAMA (Putih dengan Shading Lembut) -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6">
        
        <!-- ========================================== -->
        <!-- 2. HEADER TABEL (Judul, Tombol Tambah, & Search) -->
        <!-- ========================================== -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h3 class="text-xl font-bold text-gray-800">Transaksi Bahan</h3>
            
            <div class="flex items-center space-x-3 self-end sm:self-auto">
                <!-- Tombol Tambah Transaksi -->
                <button class="bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm px-4 py-2.5 rounded-lg flex items-center transition duration-200 cursor-pointer shadow-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Transaksi
                </button>

                <!-- Input Pencarian -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari Transaksi" class="w-64 pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400">
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 3. STRUKTUR TABEL DATA -->
        <!-- ========================================== -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm font-bold text-gray-800 bg-gray-50/50">
                        <th class="py-3.5 px-4 w-16">No</th>
                        <th class="py-3.5 px-4">Tanggal</th>
                        <th class="py-3.5 px-4">Nama</th>
                        <th class="py-3.5 px-4">Detail Transaksi</th>
                        <th class="py-3.5 px-4 w-24">Jumlah</th>
                        <th class="py-3.5 px-4">Total</th>
                        <th class="py-3.5 px-4">status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @foreach($transaksiBahan as $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-4 font-medium text-gray-500">{{ $item['no'] }}</td>
                        <td class="py-4 px-4 text-gray-500">{{ $item['tanggal'] }}</td>
                        <td class="py-4 px-4 font-medium text-gray-700">{{ $item['nama'] }}</td>
                        <td class="py-4 px-4 text-slate-500 max-w-xs truncate md:max-w-none md:whitespace-normal">{{ $item['detail'] }}</td>
                        <td class="py-4 px-4 font-medium text-gray-700">{{ $item['jumlah'] }}</td>
                        <td class="py-4 px-4 font-medium text-gray-700">{{ $item['total'] }}</td>
                        <td class="py-4 px-4">
                            <!-- Status Hijau Sesuai Gambar Figma -->
                            <span class="text-[#28A745] font-semibold text-sm">
                                {{ $item['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ========================================== -->
        <!-- 4. NAVIGASI PAGINATION (Sesuai Gambar Figma) -->
        <!-- ========================================== -->
        <div class="flex justify-end mt-6">
            <nav class="inline-flex space-x-2 text-sm font-semibold">
                <!-- Tombol Sebelumnya (Abu-abu) -->
                <button class="w-8 h-8 rounded bg-[#9BB1AA] text-white flex items-center justify-center cursor-pointer hover:bg-emerald-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                    </svg>
                </button>

                <!-- Halaman 1 (Aktif - Hijau Tua Riska Sulam) -->
                <a href="#" class="w-8 h-8 rounded bg-[#004D39] text-white flex items-center justify-center shadow-sm">1</a>

                <!-- Halaman Lain (Border Hijau Toska) -->
                <a href="#" class="w-8 h-8 rounded border border-[#008080] text-[#008080] flex items-center justify-center hover:bg-teal-50 transition">2</a>
                <a href="#" class="w-8 h-8 rounded border border-[#008080] text-[#008080] flex items-center justify-center hover:bg-teal-50 transition">3</a>
                <span class="w-8 h-8 rounded border border-[#008080] text-[#008080] flex items-center justify-center">...</span>

                <!-- Tombol Selanjutnya (Abu-abu) -->
                <button class="w-8 h-8 rounded bg-[#9BB1AA] text-white flex items-center justify-center cursor-pointer hover:bg-emerald-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>
            </nav>
        </div>

    </div>
</x-layout>