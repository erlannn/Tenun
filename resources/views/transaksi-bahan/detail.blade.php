<x-app-layout>
    <div class="container mx-auto p-6" style="max-width: 960px;">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold" style="color: #2c3e50;">Detail Transaksi Bahan</h1>
            <a href="/transaksi-bahan" class="bg-[#DDAE3B] text-[#004D39] px-4 py-2 rounded-xl font-medium hover:bg-[#DDAE3B]/80 transition duration-200">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow rounded-lg p-4 mb-6" style="border-left: 4px solid #3498db;">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id_transaksi }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_pesan }}</p>
            <p><strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nm_pelanggan ?? 'Tidak Diketahui' }}</p>
        </div>

        <table class="w-full border-collapse" style="border: 1px solid #ddd;">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2 text-left" style="background:#ecf0f1;">Nama Bahan</th>
                    <th class="border p-2 text-right" style="background:#ecf0f1;">Qty</th>
                    <th class="border p-2 text-right" style="background:#ecf0f1;">Harga</th>
                    <th class="border p-2 text-right" style="background:#ecf0f1;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">{{ $item->nama }}</td>
                        <td class="border p-2 text-right">{{ $item->qty }}</td>
                        <td class="border p-2 text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="border p-2 text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-200 font-bold">
                    <td class="border p-2" colspan="3" style="text-align: right;">Total</td>
                    <td class="border p-2 text-right">{{ $total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>