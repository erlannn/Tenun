<x-app-layout>
    <x-slot:title>Laporan Transaksi</x-slot:title>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 max-w-[1400px] mx-auto">
        
        <form id="laporan-filter-form" method="GET" action="{{ route('laporan') }}" class="flex flex-wrap items-end gap-4 justify-start border-b border-gray-100 pb-6 mb-6">
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
                        <svg class="w-1 h-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="self-end">
                <button type="submit" class="bg-[#008080] hover:bg-teal-700 text-white font-medium text-sm px-5 py-2 rounded-lg transition duration-200 shadow-sm cursor-pointer whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Filter
                </button>
            </div>

            <div class="self-end">
                <a id="btn-cetak" href="{{ route('laporan.cetak', request()->only(['dari_tanggal','sampai_tanggal','jenis_transaksi','cari'])) }}" class="font-medium text-sm px-5 py-2 rounded-lg transition duration-200 shadow-sm whitespace-nowrap flex items-center gap-2 {{ $sudah_filter ? 'bg-[#585ddf] hover:bg-blue-800 text-white cursor-pointer' : 'bg-gray-300 text-gray-500 cursor-not-allowed pointer-events-none' }}" {{ $sudah_filter ? '' : 'aria-disabled=true' }}>
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                    Cetak
                </a>
            </div>

            <div class="ml-auto w-full sm:w-72 lg:w-72 self-end">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Laporan" 
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
    @forelse($transaksi as $index => $item)
        <tr class="hover:bg-gray-50/50 transition">
            <td class="py-4 px-4 font-medium text-gray-500">
                {{ $transaksi->firstItem() + $index }}
            </td>
            <td class="py-4 px-4 font-medium text-slate-700">
                {{ $item->pelanggan->nm_pelanggan ?? 'Umum' }}
            </td>
            <td class="py-4 px-4 text-slate-500">
                {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d/m/Y') }}
            </td>
            <td class="py-4 px-4 text-slate-600">
                <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $item->jenis_transaksi == 'Bahan' ? 'bg-emerald-50 text-emerald-600' : 'bg-indigo-50 text-indigo-600' }}">
                    {{ $item->jenis_transaksi }}
                </span>
            </td>
            
            <td class="py-4 px-4 text-right font-medium text-slate-700">
                @php
                    $totalRow = $item->getAttribute('total_laporan') ?? 0;
                @endphp
                Rp. {{ number_format($totalRow, 0, ',', '.') }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="py-12 text-center text-gray-400 bg-gray-50/20">
                <p class="text-sm">Tidak ditemukan data transaksi riil dalam database.</p>
            </td>
        </tr>
    @endforelse
</tbody>
            </table>
        </div>

        <div class="mt-6 space-y-4">
            <div class="text-right">
                <p class="text-base font-extrabold text-gray-900">
                    Total Keseluruhan : <span class="text-[#008080]">Rp. {{ number_format($total_keseluruhan, 0, ',', '.') }}</span>
                </p>
            </div>

            <div class="flex justify-end pt-2">
                {{ $transaksi->links() }}
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('laporan-filter-form');
            const button = document.getElementById('btn-cetak');

            if (!form || !button) return;

            const fields = [
                form.querySelector('input[name="dari_tanggal"]'),
                form.querySelector('input[name="sampai_tanggal"]'),
                form.querySelector('input[name="cari"]'),
                form.querySelector('select[name="jenis_transaksi"]')
            ].filter(Boolean);

            const hasActiveFilter = () => fields.some((field) => (field.value || '').trim() !== '');

            const toggleCetakButton = () => {
                const active = hasActiveFilter();
                button.classList.toggle('bg-gray-300', !active);
                button.classList.toggle('text-gray-500', !active);
                button.classList.toggle('cursor-not-allowed', !active);
                button.classList.toggle('pointer-events-none', !active);
                button.classList.toggle('bg-[#585ddf]', active);
                button.classList.toggle('hover:bg-blue-800', active);
                button.classList.toggle('text-white', active);
                button.classList.toggle('cursor-pointer', active);
                button.setAttribute('aria-disabled', String(!active));
                if (!active) {
                    button.removeAttribute('href');
                } else {
                    const params = new URLSearchParams(new FormData(form));
                    button.href = '{{ route('laporan.cetak') }}?' + params.toString();
                }
            };

            fields.forEach((field) => {
                field.addEventListener('input', toggleCetakButton);
                field.addEventListener('change', toggleCetakButton);
            });

            toggleCetakButton();
        });
    </script>
</x-app-layout>