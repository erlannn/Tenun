<x-app-layout>
    <x-slot:title>Laporan Transaksi</x-slot:title>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 max-w-[1400px] mx-auto">
        
        <form method="GET" action="{{ route('laporan') }}" class="flex flex-wrap items-end gap-4 justify-start border-b border-gray-100 pb-6 mb-6">
            <div class="w-full sm:w-36">
                <label for="dari_tanggal" class="block text-sm font-bold text-gray-700 mb-2">Dari tanggal</label>
                <input type="date" name="dari_tanggal" id="dari_tanggal" value="{{ request('dari_tanggal') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#008080] focus:ring-1 focus:ring-[#008080] transition text-gray-600">
            </div>

            <div class="w-full sm:w-36">
                <label for="sampai_tanggal" class="block text-sm font-bold text-gray-700 mb-2">Sampai tanggal</label>
                <input type="date" name="sampai_tanggal" id="sampai_tanggal" value="{{ request('sampai_tanggal') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#008080] focus:ring-1 focus:ring-[#008080] transition text-gray-600">
            </div>

            <div class="w-full sm:w-40">
                <label for="jenis_transaksi" class="block text-sm font-bold text-gray-700 mb-2">Jenis transaksi</label>
                <div class="relative">
                    <select name="jenis_transaksi" id="jenis_transaksi" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white appearance-none focus:outline-none focus:border-[#008080] focus:ring-1 focus:ring-[#008080] transition text-gray-600 pr-8">
                        <option value="">Semua Jenis</option>
                        <option value="Bahan" {{ request('jenis_transaksi') == 'Bahan' ? 'selected' : '' }}>Bahan</option>
                        <option value="Preorder" {{ request('jenis_transaksi') == 'Preorder' ? 'selected' : '' }}>Preorder</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <div class="self-end">
                <button type="submit" name="filter" value="1" class="bg-[#008080] hover:bg-teal-700 text-white font-medium text-sm px-5 py-2 rounded-lg transition duration-200 shadow-sm cursor-pointer whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-[#008080] focus:ring-offset-2 focus:ring-offset-white">
                    Filter
                </button>
            </div>

            <div class="ml-auto w-full sm:w-72 lg:w-72 self-end">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Laporan" 
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#008080] focus:ring-1 focus:ring-[#008080] transition placeholder-gray-400"/>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm font-bold text-gray-800 bg-gray-50/50">
                        <th class="py-3.5 px-4 w-16">No</th>
                        <th class="py-3.5 px-4">Nama Pelanggan</th>
                        <th class="py-3.5 px-4">Tanggal</th>
                        <th class="py-3.5 px-4">Jenis transaksi</th>
                        <th class="py-3.5 px-4 w-32 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @php
                        // Data statis frontend sesuai mockup awal agar tabel terisi rapi
                        $reports = collect([
                            (object) ['nama' => 'Isfa', 'tanggal' => '22/06/2026', 'jenis' => 'Bahan', 'total' => 30000],
                            (object) ['nama' => 'Zee', 'tanggal' => '22/06/2026', 'jenis' => 'Bahan', 'total' => 80000],
                            (object) ['nama' => 'Freya', 'tanggal' => '03/06/2026', 'jenis' => 'Bahan', 'total' => 50000],
                            (object) ['nama' => 'Oline', 'tanggal' => '03/06/2026', 'jenis' => 'Preorder', 'total' => 500000],
                            (object) ['nama' => 'Delyn', 'tanggal' => '03/06/2026', 'jenis' => 'Preorder', 'total' => 500000],
                        ]);
                    @endphp

                    @forelse($reports as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-4 font-medium text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 font-medium text-slate-700">{{ $item->nama }}</td>
                            <td class="py-4 px-4 text-slate-500">{{ $item->tanggal }}</td>
                            <td class="py-4 px-4 text-slate-600">{{ $item->jenis }}</td>
                            <td class="py-4 px-4 text-right font-medium text-slate-700">
                                {{ number_format($item->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-400">Data laporan tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 space-y-4">
            <div class="text-right">
                <p class="text-base font-extrabold text-gray-900">
                    Total Keseluruhan : <span>Rp. 3.800.000</span>
                </p>
            </div>

            <div class="flex justify-end">
                <nav class="inline-flex items-center -space-x-px text-xs font-medium">
                    <button class="px-2.5 py-1.5 rounded-l-lg bg-slate-400 text-white hover:bg-slate-500 transition shadow-sm mr-1"><</button>
                    <button class="px-3 py-1.5 bg-[#008080] text-white rounded font-bold shadow-sm">1</button>
                    <button class="px-3 py-1.5 bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 rounded ml-1 transition shadow-sm">2</button>
                    <button class="px-3 py-1.5 bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 rounded ml-1 transition shadow-sm">3</button>
                    <span class="px-3 py-1.5 bg-white border border-gray-300 text-gray-400 rounded ml-1">...</span>
                    <button class="px-2.5 py-1.5 rounded-r-lg bg-slate-400 text-white hover:bg-slate-500 transition shadow-sm ml-1">></button>
                </nav>
            </div>
        </div>

    </div>
</x-app-layout>