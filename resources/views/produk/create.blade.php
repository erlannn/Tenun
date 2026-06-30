<x-app-layout>
    <x-slot:title>Tambah Produk</x-slot:title>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Tambah Produk</h3>
        
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-200 text-red-800 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="nm_produk" value="{{ old('nm_produk') }}" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500" required />
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="id_kategori" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm text-gray-600" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                {{ $kat->nm_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" step="0.01" name="harga" value="{{ old('harga') }}" class="mt-1 w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Lampiran Foto (Format: PNG)</label>
                    <input type="file" name="foto" accept="image/png" class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-1" />
                    <p class="text-xs text-gray-500 mt-1">*Maksimal ukuran file 1MB dan harus berformat .png</p>
                </div>
                
                <div class="flex justify-center space-x-3 mt-4">
                    <a href="{{ route('data-produk') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-[#007BFF] text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>