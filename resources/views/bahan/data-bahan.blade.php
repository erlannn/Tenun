<x-app-layout>
    <x-slot:title>Data Bahan</x-slot:title>
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h3 class="text-xl font-bold text-gray-800">Data Bahan</h3>
            <div class="flex items-center space-x-3 self-end sm:self-auto">
                <a href="{{ route('bahan.create') }}" class="bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm px-4 py-2.5 rounded-lg flex items-center transition duration-200 cursor-pointer shadow-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Bahan
                </a>
                <form method="GET" action="{{ route('data-bahan') }}" class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari Bahan" class="w-64 pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400"/>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm font-bold text-gray-800 bg-gray-50/50">
                        <th class="py-3.5 px-4 w-16">No</th>
                        <th class="py-3.5 px-4">Nama Bahan</th>
                        <th class="py-3.5 px-4">Stok</th>
                        <th class="py-3.5 px-4">Satuan</th>
                        <th class="py-3.5 px-4">Harga Satuan</th>
                        <th class="py-3.5 px-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @forelse($bahan as $index => $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-4 font-medium text-gray-500">{{ $bahan->firstItem() + $index }}</td>
                        <td class="py-4 px-4 font-medium text-slate-700">{{ $item->nm_bahan }}</td>
                        <td class="py-4 px-4 text-slate-500">{{ $item->stok }}</td>
                        <td class="py-4 px-4 text-slate-500">{{ $item->satuan ?? '-' }}</td>
                        <td class="py-4 px-4 font-medium text-gray-700">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('bahan.edit', $item) }}" class="p-2 rounded-lg bg-[#E2F5E9] text-[#28A745] hover:bg-[#28A745] hover:text-white transition duration-200 cursor-pointer" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>
                                </a>
                                <form method="POST" action="{{ route('bahan.destroy', $item) }}" onsubmit="return confirm('Yakin hapus bahan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-[#FCE8E6] text-[#DC3545] hover:bg-[#DC3545] hover:text-white transition duration-200 cursor-pointer" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">Data bahan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-6">
            {{ $bahan->links() }}
        </div>

    </div>
</x-app-layout>