<x-app-layout>
    <x-slot:title>Transaksi Preorder</x-slot:title>
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6">

        <!-- Header: Judul, Navigasi Status, Tombol Tambah, & Pencarian -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Transaksi Preorder</h3>
                <!-- Navigasi Status (Filter) -->
                <div class="flex items-center space-x-1 text-sm mt-1 text-red-500 font-medium">
                    <a href="">Semua</a>
                    <span>|</span>
                    <a href="">Diproses</a>
                    <span>|</span>
                    <a href="">Selesai</a>
                    <span>|</span>
                </div>
            </div>

            <div class="flex items-center space-x-3 self-end lg:self-auto">
                <!-- Tombol Tambah Transaksi -->
                <a href="" class="bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm px-4 py-2.5 rounded-lg flex items-center transition duration-200 cursor-pointer shadow-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Transaksi
                </a>
                <!-- Form Pencarian -->
                <form method="GET" action="" class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="" placeholder="Cari Transaksi" class="w-64 pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400"/>
                </form>
            </div>
        </div>

        <!-- Tabel Transaksi Preorder -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm font-bold text-gray-800 bg-gray-50/50">
                        <th class="py-3.5 px-4 w-16">No</th>
                        <th class="py-3.5 px-4">Tanggal Pemesanan</th>
                        <th class="py-3.5 px-4">Nama</th>
                        <th class="py-3.5 px-4">Produk</th>
                        <th class="py-3.5 px-4">Motif</th>
                        <th class="py-3.5 px-4">Total</th>
                        <th class="py-3.5 px-4">Tanggal Selesai</th>
                        <th class="py-3.5 px-4">status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-4 font-medium text-gray-500"></td>
                        <td class="py-4 px-4 text-slate-600"></td>
                        <td class="py-4 px-4 font-medium text-slate-700"></td>
                        <td class="py-4 px-4 text-slate-600"></td>
                        <td class="py-4 px-4 text-slate-600 text-center sm:text-left"></td>
                        <td class="py-4 px-4 font-medium text-slate-700">
                        </td>
                        <td class="py-4 px-4 text-slate-600"></td>
                        <td class="py-4 px-4 font-bold">
                             <span class="text-[#007BFF]">Diproses</span>
                                <span class="text-[#28A745]">Selesai</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        {{-- <div class="flex justify-end mt-6">
            {{ $preorder->links() }}
        </div> --}}

    </div>
</x-app-layout>