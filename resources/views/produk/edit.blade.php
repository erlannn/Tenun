<x-app-layout>
    <x-slot:title>Edit Produk</x-slot:title>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Produk</h3>
        
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-200 text-red-800 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('produk.update', $produk) }}">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 gap-4">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="nm_produk" value="{{ old('nm_produk', $produk->nm_produk) }}" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500" required />
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="id_kategori" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm text-gray-600" required>
                        <option value="" disabled>-- Pilih Kategori --</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}" {{ old('id_kategori', $produk->id_kategori) == $kat->id_kategori ? 'selected' : '' }}>
                                {{ $kat->nm_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" step="0.01" name="harga" value="{{ old('harga', (float) $produk->harga) }}" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500" required />
                </div>
                
                <div class="flex justify-end space-x-3 mt-4">
                    <a href="{{ route('data-produk') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-[#007BFF] text-white rounded-lg hover:bg-blue-700 transition">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>