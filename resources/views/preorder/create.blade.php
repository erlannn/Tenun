<x-app-layout>
    <x-slot:title>Tambah Preorder</x-slot:title>
    
    <div class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6">
        <a href="" class="hover:text-blue-600 transition">Transaksi Preorder</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-700">Tambah Preorder</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start max-w-[1400px] mx-auto">
        
        <div class="lg:col-span-5 bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-5">
            <form id="formPreorder" method="POST" action="#">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                    <input type="text" name="nama" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No Hp</label>
                    <input type="text" name="no_hp" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Produk</label>
                    <div class="relative">
                        <select name="produk" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-white appearance-none focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition pr-10 text-gray-500">
                            <option value="">-Pilih Produk-</option>
                            <option value="selendang">Selendang</option>
                            <option value="baju">Baju</option>
                            <option value="tas">Tas</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Motif</label>
                    <div class="relative">
                          <select name="produk" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-white appearance-none focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition pr-10 text-gray-500">
                            <option value="">-Pilih Motif-</option>
                            <option value="selendang">A</option>
                            <option value="baju">B</option>
                            <option value="tas">c</option>
                        </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                    <input type="number" name="jumlah" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Perkiraan Selesai</label>
                    <div class="relative">
                        <input type="date" name="perkiraan_selesai" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition text-gray-600">
                    </div>
                </div>
            </form>
        </div>

        <div class="lg:col-span-7 space-y-6">
            
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h4 class="text-base font-bold text-emerald-900 mb-4">Bahan yang digunakan</h4>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="text-gray-400 font-medium border-b border-gray-100">
                                <th class="py-2 px-2 w-32">Bahan</th>
                                <th class="py-2 px-2 text-center">Stok</th>
                                <th class="py-2 px-4 text-center w-44">Jumlah Pakai</th>
                                <th class="py-2 px-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-gray-600">
                            <tr>
                                <td class="py-3 px-2 font-medium text-gray-700">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span>Kain Satin</span>
                                    </label>
                                </td>
                                <td class="py-3 px-2 text-center text-gray-500">15</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-emerald-600 font-bold text-lg px-1">+</button>
                                        <input type="text" value="1" class="w-10 text-center border border-emerald-600 rounded p-0.5 text-xs text-gray-700">
                                        <button class="text-gray-400 font-bold text-lg px-1">-</button>
                                        <span class="text-gray-400 text-[11px] font-medium ml-1">Meter</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-right font-medium text-gray-500">50.000</td>
                            </td>
                            <tr>
                                <td class="py-3 px-2 font-medium text-gray-700">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span>Kain Kanvas</span>
                                    </label>
                                </td>
                                <td class="py-3 px-2 text-center text-gray-500">5</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-emerald-600 font-bold text-lg px-1">+</button>
                                        <input type="text" value="1" class="w-10 text-center border border-emerald-600 rounded p-0.5 text-xs text-gray-700">
                                        <button class="text-gray-400 font-bold text-lg px-1">-</button>
                                        <span class="text-gray-400 text-[11px] font-medium ml-1">Meter</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-right font-medium text-gray-500">50.000</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-2 font-medium text-gray-700">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span>Benang Emas</span>
                                    </label>
                                </td>
                                <td class="py-3 px-2 text-center text-gray-500">8</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-emerald-600 font-bold text-lg px-1">+</button>
                                        <input type="text" value="1" class="w-10 text-center border border-emerald-600 rounded p-0.5 text-xs text-gray-700">
                                        <button class="text-gray-400 font-bold text-lg px-1">-</button>
                                        <span class="text-gray-400 text-[11px] font-medium ml-1">Rol</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-right font-medium text-gray-500">50.000</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-2 font-medium text-gray-700">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span>Kain Beludru</span>
                                    </label>
                                </td>
                                <td class="py-3 px-2 text-center text-gray-500">10</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-emerald-600 font-bold text-lg px-1">+</button>
                                        <input type="text" value="1" class="w-10 text-center border border-emerald-600 rounded p-0.5 text-xs text-gray-700">
                                        <button class="text-gray-400 font-bold text-lg px-1">-</button>
                                        <span class="text-gray-400 text-[11px] font-medium ml-1">Rol</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-right font-medium text-gray-500">50.000</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-2 font-medium text-gray-700">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span>Manik-Manik</span>
                                    </label>
                                </td>
                                <td class="py-3 px-2 text-center text-gray-500">20</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="text-emerald-600 font-bold text-lg px-1">+</button>
                                        <input type="text" value="1" class="w-10 text-center border border-emerald-600 rounded p-0.5 text-xs text-gray-700">
                                        <button class="text-gray-400 font-bold text-lg px-1">-</button>
                                        <span class="text-gray-400 text-[11px] font-medium ml-1">Pack</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2 text-right font-medium text-gray-500">50.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end space-x-1 mt-4">
                    <button class="p-1 px-2.5 bg-slate-400 hover:bg-slate-500 text-white rounded text-xs transition shadow-sm"><</button>
                    <button class="p-1 px-2.5 bg-slate-400 hover:bg-slate-500 text-white rounded text-xs transition shadow-sm">></button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h4 class="text-base font-bold text-emerald-900 mb-4">Ringkasan Biaya</h4>
                
                <div class="border border-gray-100 rounded-xl p-4 space-y-3 text-sm">
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Total bahan</span>
                        <span class="font-medium text-gray-700">Rp. 480.000</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Biaya jasa sulam</span>
                        <span class="font-medium text-gray-700">Rp. 200.000</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-100 pt-3 text-red-500 font-bold">
                        <span>Total</span>
                        <span class="text-base">Rp. 680.000</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center space-x-4 pt-2">
                <a href="" 
                    class="px-8 py-2 bg-[#DC3545] hover:bg-red-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer text-center">
                    Batal
                </a>
                <button type="submit" form="formPreorder"
                    class="px-8 py-2 bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer">
                    simpan
                </button>
            </div>

        </div>
    </div>
</x-app-layout>