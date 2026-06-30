<x-app-layout>
    <x-slot:title>Tambah Preorder</x-slot:title>
    
    <div class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6 max-w-[1400px] mx-auto">
        <a href="/transaksi-preorder" class="hover:text-blue-600 transition">Transaksi Preorder</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-700">Tambah Transaksi Preorder</span>
    </div>

    <!-- Notification Alerts -->
    @if($errors->any())
        <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm text-sm font-medium max-w-[1400px] mx-auto">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start max-w-[1400px] mx-auto mb-10">
        
        <!-- Left Side: Form Details -->
        <div class="lg:col-span-5 bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-5">
            <form id="formPreorder" method="POST" action="{{ route('transaksi-preorder.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No Hp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Produk</label>
                    <div class="relative">
                        <select name="id_produk" id="produk_select" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-white appearance-none focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition pr-10 text-gray-700">
                            <option value="">-Pilih Produk-</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga }}" {{ old('id_produk') == $p->id_produk ? 'selected' : '' }}>
                                    {{ $p->nm_produk }} (Rp. {{ number_format($p->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                            <svg class="w-1 h-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Motif</label>
                    <input type="text" name="motif" value="{{ old('motif') }}" placeholder="Contoh: Motif Pucuak Rabuang" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah_input" value="{{ old('jumlah', 1) }}" min="1" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Perkiraan Selesai</label>
                    <div class="relative">
                        <input type="date" name="perkiraan_selesai" value="{{ old('perkiraan_selesai') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-600">
                    </div>
                </div>
            </form>
        </div>

        <!-- Right Side: Materials & Cost Summary -->
        <div class="lg:col-span-7 space-y-6">
            
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h4 class="text-base font-bold text-emerald-900 mb-4">Bahan yang digunakan</h4>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-gray-400 font-medium border-b border-gray-100 pb-2">
                                <th class="py-2 px-2 w-36">Bahan</th>
                                <th class="py-2 px-2 text-center w-16">Stok</th>
                                <th class="py-2 px-4 text-center w-48">Jumlah Pakai</th>
                                <th class="py-2 px-2 text-right w-28">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-gray-600">
                            @forelse($bahan as $item)
                                <tr>
                                    <td class="py-3 px-2 font-medium text-gray-700">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="bahan[]" value="{{ $item->id_bahan }}" class="bahan-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" data-harga="{{ $item->harga }}" data-id="{{ $item->id_bahan }}">
                                            <span class="truncate max-w-[120px] inline-block">{{ $item->nm_bahan }}</span>
                                        </label>
                                    </td>
                                    <td class="py-3 px-2 text-center text-gray-500 font-medium">{{ $item->stok }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button type="button" class="btn-minus text-gray-400 font-bold text-lg px-1 select-none cursor-pointer" data-id="{{ $item->id_bahan }}">-</button>
                                            <input type="number" name="jumlah_bahan[{{ $item->id_bahan }}]" id="qty-{{ $item->id_bahan }}" value="1" min="1" max="{{ $item->stok }}" class="qty-input w-12 text-center border border-emerald-600 rounded p-0.5 text-xs text-gray-700 font-bold">
                                            <button type="button" class="btn-plus text-emerald-600 font-bold text-lg px-1 select-none cursor-pointer" data-id="{{ $item->id_bahan }}">+</button>
                                            <span class="text-gray-400 text-[11px] font-medium ml-1 truncate max-w-[30px] inline-block">{{ $item->satuan->nm_satuan ?? '' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-2 text-right font-medium text-gray-500">
                                        Rp. <span class="subtotal-bahan-display font-semibold text-slate-700" id="subtotal-display-{{ $item->id_bahan }}">0</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-400 font-medium">Bahan tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cost Summary -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h4 class="text-base font-bold text-emerald-900 mb-4">Ringkasan Biaya</h4>
                
                <div class="border border-gray-100 rounded-xl p-4 space-y-3 text-sm">
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Harga Produk</span>
                        <span class="font-medium text-gray-700" id="produk_price_display">Rp. 0</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Jumlah Pesanan</span>
                        <span class="font-medium text-gray-700" id="qty_display">1</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Estimasi Biaya Bahan</span>
                        <span class="font-semibold text-gray-700" id="total_bahan_display">Rp. 0</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-100 pt-3 text-red-500 font-bold">
                        <span>Total Pembayaran (Produk)</span>
                        <span class="text-base" id="grand_total_display">Rp. 0</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center space-x-4 pt-2">
                <a href="{{ route('transaksi-preorder') }}" 
                    class="px-8 py-2.5 bg-[#DC3545] hover:bg-red-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer text-center">
                    Batal
                </a>
                <button type="submit" form="formPreorder"
                    class="px-8 py-2.5 bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer">
                    Simpan
                </button>
            </div>

        </div>
    </div>

    <!-- Calculations Javascript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produkSelect = document.getElementById('produk_select');
            const jumlahInput = document.getElementById('jumlah_input');
            const checkboxes = document.querySelectorAll('.bahan-checkbox');
            
            // Display elements
            const produkPriceDisplay = document.getElementById('produk_price_display');
            const qtyDisplay = document.getElementById('qty_display');
            const totalBahanDisplay = document.getElementById('total_bahan_display');
            const grandTotalDisplay = document.getElementById('grand_total_display');

            function formatRupiah(num) {
                return 'Rp. ' + num.toLocaleString('id-ID');
            }

            function calculateTotals() {
                // 1. Product price
                const selectedOption = produkSelect.options[produkSelect.selectedIndex];
                const productPrice = selectedOption && selectedOption.dataset.harga ? parseFloat(selectedOption.dataset.harga) : 0;
                const quantity = parseInt(jumlahInput.value) || 1;
                const productTotal = productPrice * quantity;

                produkPriceDisplay.textContent = formatRupiah(productPrice);
                qtyDisplay.textContent = quantity;

                // 2. Materials price
                let materialsTotal = 0;
                checkboxes.forEach(cb => {
                    const id = cb.dataset.id;
                    const price = parseFloat(cb.dataset.harga) || 0;
                    const qtyInput = document.getElementById('qty-' + id);
                    const qty = parseInt(qtyInput.value) || 1;
                    
                    const subtotal = price * qty;
                    const subtotalDisplay = document.getElementById('subtotal-display-' + id);
                    
                    if (cb.checked) {
                        subtotalDisplay.textContent = subtotal.toLocaleString('id-ID');
                        materialsTotal += subtotal;
                    } else {
                        subtotalDisplay.textContent = '0';
                    }
                });

                totalBahanDisplay.textContent = formatRupiah(materialsTotal);

                // 3. Grand Total (Product Payment)
                grandTotalDisplay.textContent = formatRupiah(productTotal);
            }

            // Event listeners
            produkSelect.addEventListener('change', calculateTotals);
            jumlahInput.addEventListener('input', calculateTotals);

            checkboxes.forEach(cb => {
                cb.addEventListener('change', calculateTotals);
                
                const id = cb.dataset.id;
                const qtyInput = document.getElementById('qty-' + id);
                
                qtyInput.addEventListener('input', calculateTotals);
                
                // Plus button
                const btnPlus = document.querySelector(`.btn-plus[data-id="${id}"]`);
                if (btnPlus) {
                    btnPlus.addEventListener('click', function () {
                        const max = parseInt(qtyInput.getAttribute('max')) || 999;
                        let val = parseInt(qtyInput.value) || 0;
                        if (val < max) {
                            qtyInput.value = val + 1;
                            calculateTotals();
                        }
                    });
                }
                
                // Minus button
                const btnMinus = document.querySelector(`.btn-minus[data-id="${id}"]`);
                if (btnMinus) {
                    btnMinus.addEventListener('click', function () {
                        let val = parseInt(qtyInput.value) || 0;
                        if (val > 1) {
                            qtyInput.value = val - 1;
                            calculateTotals();
                        }
                    });
                }
            });

            calculateTotals();
        });
    </script>
</x-app-layout>