<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>
    @php
        $totalTransaksiHariIni = 10;
        $totalPreorderActive = 5;
        $totalPenjualanBahan = 8;
        $stokKritis = [
            ['nama' => 'Benang Emas', 'sisa' => 'Sisa 5 rol'],
            ['nama' => 'Payet Gold', 'sisa' => 'Sisa 8 pack'],
            ['nama' => 'Kain Satin Premium', 'sisa' => 'Sisa 3 m'],
        ];
    @endphp

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <!-- Card 1: Total Transaksi -->
        <div class="bg-[#FAF6E9] p-6 rounded-xl shadow-md border border-gray-100/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-[#D4AF37] flex items-center justify-center text-white shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#004D39] tracking-wider uppercase opacity-80">Total Transaksi Hari Ini</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-0.5">{{ $totalTransaksiHariIni }}</h3>
                <p class="text-xs text-gray-500 font-medium">Transaksi</p>
            </div>
        </div>
        <!-- Card 2: Total Preorder -->
        <div class="bg-[#FAF6E9] p-6 rounded-xl shadow-md border border-gray-100/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-[#D4AF37] flex items-center justify-center text-white shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#004D39] tracking-wider uppercase opacity-80">Total Preorder</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-0.5">{{ $totalPreorderActive }}</h3>
                <p class="text-xs text-gray-500 font-medium">Pesanan</p>
            </div>
        </div>
        <!-- Card 3: Penjualan Bahan -->
        <div class="bg-[#FAF6E9] p-6 rounded-xl shadow-md border border-gray-100/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-[#D4AF37] flex items-center justify-center text-white shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#004D39] tracking-wider uppercase opacity-80">Penjualan Bahan</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-0.5">{{ $totalPenjualanBahan }}</h3>
                <p class="text-xs text-gray-500 font-medium">Transaksi</p>
            </div>
        </div>
    </div>

    <!-- AREA BAWAH (2 KOLOM: STOK & GRAFIK) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        <!-- KOLOM KIRI: Stok Bahan Hampir Habis -->
        <div class="bg-[#FAF6E9]/50 p-6 rounded-xl shadow-md border border-gray-100 lg:col-span-5 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-lg text-[#004D39] mb-6 tracking-tight">Stok Bahan Hampir Habis</h3>
                <div class="space-y-4">
                    @foreach($stokKritis as $bahan)
                    <div class="flex justify-between items-center p-3.5 bg-[#FAF6E9] rounded-xl border border-gray-200/40">
                        <span class="font-semibold text-sm text-gray-800 flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-[#FAF6E9] flex items-center justify-center mr-3 shrink-0 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-[#D4AF37]"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                            </div>
                            {{ $bahan['nama'] }}
                        </span>
                        <span class="text-red-700 font-bold text-xs">{{ $bahan['sisa'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
          <button type="button" onclick="window.location.href='{{ route('data-bahan') }}'" 
    class="mt-8 w-full py-2.5 border border-[#008080] text-[#008080] font-bold text-sm rounded-xl bg-white hover:bg-[#008080] hover:text-white transition duration-200 cursor-pointer">
    Lihat Semua Stok
</button>
        </div>
        <!-- KOLOM KANAN: Grafik Penjualan -->
        <div class="bg-[#FAF6E9]/50 p-6 rounded-xl shadow-md border border-gray-100 lg:col-span-7 flex flex-col">
            <h3 class="font-bold text-lg text-[#004D39] mb-4 tracking-tight">Grafik Penjualan <span class="text-sm text-gray-500 font-normal">(30 Hari Terakhir)</span></h3>
            <div class="w-full flex-1 min-h-[260px] relative">
                <canvas id="dashboardChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('dashboardChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['28 Apr', '5 Mei', '12 Mei', '19 Mei', '126 Mei'],
                    datasets: [
                        {
                            label: 'Preorder',
                            data: [7, 14, 4, 7, 14, 3, 6],
                            borderColor: '#004D39',
                            backgroundColor: 'transparent',
                            borderWidth: 1.5,
                            pointBackgroundColor: '#004D39',
                            pointRadius: 3,
                            tension: 0
                        },
                        {
                            label: 'Penjualan Bahan',
                            data: [12, 12, 5, 11, 15, 5, 8],
                            borderColor: '#D4AF37',
                            backgroundColor: 'transparent',
                            borderWidth: 1.5,
                            pointBackgroundColor: '#D4AF37',
                            pointRadius: 3,
                            tension: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { min: 0, max: 20, ticks: { stepSize: 5 } }
                    },
                    plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 6 } } }
                }
            });
        });
    </script>
</x-app-layout>
