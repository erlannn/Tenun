<x-app-layout>
    <x-slot:title>Tambah Bahan</x-slot:title>
    
    <div class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6">
        <a href="{{ route('data-bahan') }}" class="hover:text-blue-600 transition">Data Bahan</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-700">Tambah Bahan</span>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-8 max-w-5xl mx-auto">
        <form method="POST" action="{{ route('bahan.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="nm_bahan" class="block text-sm font-semibold text-gray-700 mb-2">Nama Bahan</label>
                <input type="text" name="nm_bahan" id="nm_bahan" value="{{ old('nm_bahan') }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('nm_bahan') border-red-500 @enderror">
                @error('nm_bahan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                <input type="number" name="stok" id="stok" value="{{ old('stok', 7) }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('stok') border-red-500 @enderror">
                @error('stok')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="satuan" class="block text-sm font-semibold text-gray-700 mb-2">Satuan</label>
                <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('satuan') border-red-500 @enderror">
                @error('satuan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="harga_satuan" class="block text-sm font-semibold text-gray-700 mb-2">Harga Satuan</label>
                <input type="number" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan') }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition @error('harga_satuan') border-red-500 @enderror">
                @error('harga_satuan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center items-center space-x-4 pt-4">
                <a href="{{ route('data-bahan') }}" 
                    class="px-8 py-2.5 bg-[#DC3545] hover:bg-red-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer">
                    Batal
                </a>
                <button type="submit" 
                    class="px-8 py-2.5 bg-[#007BFF] hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition duration-200 shadow-sm cursor-pointer">
                    simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>