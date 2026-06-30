<x-app-layout>
    <x-slot:title>Transaksi Preorder</x-slot:title>
    
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6 max-w-[1400px] mx-auto">

        <!-- Notification Alerts -->
        @if(session('success'))
            <div class="mb-5 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg shadow-sm text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header: Judul, Navigasi Status, Tombol Tambah, & Pencarian -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Transaksi Preorder</h3>
                <!-- Navigasi Status (Filter) -->
                <div class="flex items-center space-x-2 text-sm mt-2 font-medium">
                    <span class="text-gray-400">Filter:</span>
                    <a href="{{ route('transaksi-preorder', ['status' => 'semua', 'search' => $search]) }}" 
                       class="px-2.5 py-0.5 rounded-full transition {{ $status === 'semua' ? 'bg-gray-100 text-gray-800 font-bold' : 'text-gray-500 hover:text-gray-800' }}">
                       Semua
                    </a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('transaksi-preorder', ['status' => 'diproses', 'search' => $search]) }}" 
                       class="px-2.5 py-0.5 rounded-full transition {{ $status === 'diproses' ? 'bg-blue-50 text-[#007BFF] font-bold' : 'text-gray-500 hover:text-[#007BFF]' }}">
                       Diproses
                    </a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('transaksi-preorder', ['status' => 'selesai', 'search' => $search]) }}" 
                       class="px-2.5 py-0.5 rounded-full transition {{ $status === 'selesai' ? 'bg-emerald-50 text-[#28A745] font-bold' : 'text-gray-500 hover:text-[#28A745]' }}">
                       Selesai
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-3 self-end lg:self-auto">
                <!-- Tombol Tambah Transaksi -->
                <a href="{{ route('transaksi-preorder.create') }}" class="bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm px-4 py-2.5 rounded-lg flex items-center transition duration-200 cursor-pointer shadow-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Transaksi
                </a>
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('transaksi-preorder') }}" class="relative">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari Pelanggan..." class="w-64 pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400"/>
                </form>
            </div>
        </div>

        <!-- Tabel Transaksi Preorder -->
        <div class="overflow-x-auto border border-gray-100 rounded-lg shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm font-bold text-gray-800 bg-gray-50/50">
                        <th class="py-3.5 px-4 w-16 text-center">No</th>
                        <th class="py-3.5 px-4">Tanggal Pemesanan</th>
                        <th class="py-3.5 px-4">Nama Pelanggan</th>
                        <th class="py-3.5 px-4">Produk</th>
                        <th class="py-3.5 px-4">Motif</th>
                        <th class="py-3.5 px-4">Total</th>
                        <th class="py-3.5 px-4">Tanggal Selesai</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @forelse($preorder as $index => $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-4 text-center font-medium text-gray-500">{{ $preorder->firstItem() + $index }}</td>
                            <td class="py-4 px-4 text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}</td>
                            <td class="py-4 px-4 font-semibold text-slate-700">{{ $item->nama }}</td>
                            <td class="py-4 px-4 text-slate-600 font-medium">{{ $item->produk }}</td>
                            <td class="py-4 px-4 text-slate-500 italic">{{ $item->motif }}</td>
                            <td class="py-4 px-4 font-bold text-slate-700">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-slate-500">
                                {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') : '-' }}
                            </td>
                            <td class="py-4 px-4">
                                @if($item->status === 'diproses')
                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-[#007BFF]">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-[#007BFF]"></span>
                                        Diproses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-[#28A745]">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-[#28A745]"></span>
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if($item->status === 'diproses')
                                    <form action="{{ route('transaksi-preorder.updateStatus', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menandai transaksi ini sebagai Selesai?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="bg-[#28A745] hover:bg-emerald-700 text-white font-medium text-xs px-3 py-1.5 rounded-lg transition duration-200 cursor-pointer shadow-sm">
                                            Tandai Selesai
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 font-medium">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-8 text-center text-gray-400 font-medium">Data transaksi preorder tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-end mt-6">
            {{ $preorder->links() }}
        </div>

    </div>
</x-app-layout>