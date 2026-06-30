<x-app-layout>
    <x-slot:title>Edit Bahan</x-slot:title>
    
    <div class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6">
        <a href="{{ route('data-bahan') }}" class="hover:text-blue-600 transition">Data Bahan</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-700">Edit Bahan</span>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-8 max-w-5xl mx-auto">
        <form method="POST" action="{{ route('bahan.update', $bahan->id_bahan) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nm_bahan" class="block text-sm font-semibold text-gray-700 mb-2">Nama Bahan</label>
                <input type="text" name="nm_bahan" id="nm_bahan" value="{{ old('nm_bahan', $bahan->nm_bahan ?? 'Kain Satin') }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('nm_bahan') border-red-500 @enderror">
                @error('nm_bahan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                <input type="number" name="stok" id="stok" value="{{ old('stok', $bahan->stok ?? 15) }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('stok') border-red-500 @enderror">
                @error('stok')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Satuan</label>
                <select name="id_satuan" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm text-gray-600" required>
                    <option value="" disabled >-- Pilih Satuan --</option>
                    @foreach($satuan as $sat)
                        <option value="{{ $sat->id_satuan }}" {{ old('id_satuan') == $sat->id_satuan ? 'selected' : '' }}>
                            {{ $sat->nm_satuan }}
                        </option>
                    @endforeach
                </select>
                @error('id_satuan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga', $bahan->harga ?? 80000) }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('harga') border-red-500 @enderror">
                @error('harga')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center items-center space-x-4 pt-4">
                <a href="{{ route('data-bahan') }}" 
                    class="px-8 py-2.5 bg-[#DC3545] hover:bg-red-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer align-middle text-center">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-2.5 bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>