<x-app-layout>
    <x-slot:title>Tambah Transaksi</x-slot:title>

    <div class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6">
        <a href="/transaksi-bahan" class="hover:text-blue-600 transition">Transaksi Bahan</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-700">Tambah Transaksi</span>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-8 max-w-5xl mx-auto">
        <!-- Form to add an item to the cart -->
        <form method="POST" action="{{ route('transaksi-bahan.store') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="action" value="add">

            <div>
                <label for="nama_pelanggan" class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="{{ old('nama_pelanggan') ?? session('nama_pelanggan') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" required>
            </div>

            <hr class="border-gray-100 my-4">

            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200/60 space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block">Input Item Bahan</span>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_bahan" class="block text-sm font-semibold text-gray-700 mb-2">Bahan</label>
                        <select id="id_bahan" name="id_bahan" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:outline-none focus:border-blue-5 focus:ring-1 focus:ring-blue-500 text-sm text-gray-600" required>
                            <option value="">-- Pilih Bahan --</option>
                            @foreach($bahan as $b)
                                <option value="{{ $b->id_bahan }}" data-stok="{{ $b->stok }}" data-harga="{{ $b->harga }}" data-satuan="{{ $b->satuan->nm_satuan ?? '' }}">{{ $b->nm_bahan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">Stok Tersedia</label>
                            <input type="text" name="stok" id="stok" value="{{ old('stok') }}" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-300 text-gray-500 rounded-xl cursor-not-allowed">
                        </div>
                        <div>
                            <label for="satuan" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Satuan</label>
                            <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-300 text-gray-500 rounded-xl cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label for="jumlah_beli" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Beli</label>
                        <input type="number" id="jumlah_beli" name="jumlah" value="1" min="1" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-5 transition" required>
                    </div>

                    <div>
                        <label for="harga_satuan" class="block text-sm font-semibold text-gray-700 mb-2">Harga Satuan</label>
                        <input type="text" id="harga_satuan" value="" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-300 text-gray-500 rounded-xl cursor-not-allowed">
                    </div>

                    <div>
                        <button type="submit" class="w-full px-4 py-2.5 cursor-pointer bg-[#007BFF] hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition duration-200 shadow-sm flex items-center justify-center space-x-2 h-[46px]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                            <span>Tambah Item Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bahanSelect = document.getElementById('id_bahan');
        const stokInput = document.getElementById('stok');
        const hargaInput = document.getElementById('harga_satuan');
        const satuanInput = document.getElementById('satuan');

        function updateFields() {
            const selectedOption = bahanSelect.options[bahanSelect.selectedIndex];
            stokInput.value = selectedOption.getAttribute('data-stok') || '';
            hargaInput.value = selectedOption.getAttribute('data-harga') || '';
            satuanInput.value = selectedOption.getAttribute('data-satuan') || '';
        }

        bahanSelect.addEventListener('change', updateFields);
        updateFields();
    });
</script>

        <!-- Cart overview and checkout -->
        <div class="border border-gray-200 rounded-xl overflow-hidden mt-6">
            <div class="bg-gray-100 px-4 py-3 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700">Daftar Bahan Yang Dibeli</h3>
            </div>
            <div class="p-4 bg-white space-y-2 max-h-48 overflow-y-auto" id="keranjang-bahan">
                @php $cart = session('transaksi_bahan_cart', []); @endphp
                @forelse ($cart as $index => $item)
                    <div class="flex justify-between items-center bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-100 mb-2">
                        <div class="text-sm">
                            <span class="font-medium text-gray-800">{{ $item['nama'] }}</span>
                            <span class="text-gray-400 mx-1.5">•</span>
                            <span class="text-gray-600">{{ $item['jumlah'] }} {{ $item['satuan'] }}</span>
                        </div>
                        <div class="flex items-center space-x-8">
                            <span class="font-medium text-gray-800">{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                            <form method="POST" action="{{ route('transaksi-bahan.store') }}">
                                @csrf
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="index" value="{{ $index }}">
                                <button type="submit" class="text-red-500 hover:text-red-700 transition text-xs font-medium">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Keranjang masih kosong.</p>
                @endforelse
            </div>
        </div>

        @php
            $total = collect(session('transaksi_bahan_cart', []))->sum(fn($i) => $i['harga'] * $i['jumlah']);
        @endphp
        <div class="flex justify-between items-center pt-2 mt-2">
            <span class="text-base font-bold text-red-600">Total :</span>
            <span class="text-xl font-bold text-red-600" id="total-harga">{{ number_format($total,0,',','.') }}</span>
        </div>

        <!-- Checkout form -->
        <form method="POST" action="{{ route('transaksi-bahan.store') }}" class="flex justify-center items-center space-x-4 pt-4 border-t border-gray-100 mt-4">
            @csrf
            <input type="hidden" name="action" value="checkout">
            <input type="hidden" name="nama_pelanggan" value="{{ session('nama_pelanggan') }}">
            @foreach (session('transaksi_bahan_cart', []) as $item)
                <input type="hidden" name="id_bahan[]" value="{{ $item['id'] }}">
                <input type="hidden" name="jumlah[]" value="{{ $item['jumlah'] }}">
            @endforeach
            <a href="/transaksi-bahan" class="px-8 py-2.5 bg-[#DC3545] hover:bg-red-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer">Batal</a>
            <button type="submit" class="px-8 py-2.5 cursor-pointer bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm">Simpan Transaksi</button>
        </form>
    </div>
</x-app-layout>