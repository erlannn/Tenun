<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Preorder #{{ $transaksi->id_transaksi }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #1e293b;
            background-color: #ffffff;
            margin: 0;
            padding: 30px;
            font-size: 14px;
            line-height: 1.5;
        }

        .header-container {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .business-details h1 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 5px 0;
            letter-spacing: -0.025em;
        }

        .business-details p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            font-size: 20px;
            font-weight: 700;
            color: #059669; /* Emerald Green */
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }

        .invoice-title p {
            margin: 0;
            font-weight: 600;
            color: #334155;
        }

        .details-grid {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .details-grid td {
            vertical-align: top;
            padding: 0;
            width: 50%;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #94a3b8;
            margin: 0 0 8px 0;
            letter-spacing: 0.05em;
        }

        .info-box {
            color: #334155;
        }

        .info-box p {
            margin: 0 0 4px 0;
        }

        .info-box .name {
            font-weight: 600;
            font-size: 15px;
            color: #0f172a;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        .items-table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .items-table .product-name {
            font-weight: 600;
            color: #0f172a;
        }

        .items-table .motif {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px;
        }

        .items-table .number-col {
            text-align: right;
        }

        .summary-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }

        .summary-table {
            width: 320px;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 8px 0;
            color: #64748b;
        }

        .summary-table .amount {
            text-align: right;
            font-weight: 600;
            color: #0f172a;
        }

        .summary-table .grand-total-row td {
            border-top: 2px solid #e2e8f0;
            padding-top: 12px;
            font-size: 16px;
            font-weight: 700;
        }

        .summary-table .grand-total-row .label {
            color: #0f172a;
        }

        .summary-table .grand-total-row .amount {
            color: #059669; /* Emerald Green */
        }

        .footer {
            text-align: center;
            border-top: 1px dashed #cbd5e1;
            padding-top: 20px;
            margin-top: 50px;
            color: #64748b;
            font-size: 12px;
        }

        .footer p {
            margin: 0 0 5px 0;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-process {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-done {
            background-color: #d1fae5;
            color: #059669;
        }
    </style>
</head>
<body>

    <table style="width: 100%; margin-bottom: 25px;">
        <tr>
            <td style="vertical-align: top;">
                <div class="business-details">
                    <h1>RISKA SULAM & TENUN</h1>
                    <p>Penyedia Kain Tenun & Sulaman Khas Berkualitas Tinggi</p>
                    <p>Telepon: +62 812-3456-7890 | Email: riska.sulam.tenun@gmail.com</p>
                </div>
            </td>
            <td style="vertical-align: top; text-align: right;">
                <div class="invoice-title">
                    <h2>Struk Preorder</h2>
                    <p>No. Transaksi #{{ $transaksi->id_transaksi }}</p>
                    <div style="margin-top: 8px;">
                        @if($transaksi->status == 'diproses')
                            <span class="badge badge-process">Diproses</span>
                        @else
                            <span class="badge badge-done">Selesai</span>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div style="border-bottom: 2px solid #e2e8f0; margin-bottom: 25px;"></div>

    <table class="details-grid">
        <tr>
            <td>
                <h3 class="section-title">Pelanggan</h3>
                <div class="info-box">
                    <p class="name">{{ $transaksi->pelanggan->nm_pelanggan ?? 'Umum' }}</p>
                    <p>No. HP: {{ $transaksi->pelanggan->no_hp ?? '-' }}</p>
                </div>
            </td>
            <td style="text-align: right;">
                <h3 class="section-title" style="text-align: right;">Detail Pesanan</h3>
                <div class="info-box" style="text-align: right;">
                    <p>Tanggal Pesan: <strong>{{ $transaksi->tanggal_pesan ? $transaksi->tanggal_pesan->format('d-m-Y') : now()->format('d-m-Y') }}</strong></p>
                    <p>Estimasi Selesai: <strong>{{ $transaksi->tanggal_selesai ? $transaksi->tanggal_selesai->format('d-m-Y') : '-' }}</strong></p>
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th class="number-col">Harga Satuan</th>
                <th class="number-col">Jumlah</th>
                <th class="number-col">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($transaksi->detailTransaksi as $dt)
                @php 
                    $subtotal = ($dt->produk->harga ?? 0) * $dt->jumlah;
                    $grandTotal += $subtotal;
                @endphp
                <tr>
                    <td>
                        <div class="product-name">{{ $dt->produk->nm_produk ?? 'Produk Tidak Ditemukan' }}</div>
                        @if($dt->motif)
                            <div class="motif">Motif: {{ $dt->motif }}</div>
                        @endif
                    </td>
                    <td class="number-col">Rp. {{ number_format($dt->produk->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="number-col">{{ $dt->jumlah }}</td>
                    <td class="number-col">Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $bahanTotal = 0;
        $detailBahanRows = collect();

        foreach ($transaksi->detailTransaksi as $dt) {
            foreach ($dt->detailBahan as $detailBahan) {
                $subtotalBahan = (($detailBahan->bahan->harga ?? 0) * $detailBahan->jumlah_bahan);
                $bahanTotal += $subtotalBahan;
                $detailBahanRows->push([
                    'nama' => $detailBahan->bahan->nm_bahan ?? 'Bahan Tidak Ditemukan',
                    'qty' => $detailBahan->jumlah_bahan,
                    'harga' => $detailBahan->bahan->harga ?? 0,
                    'subtotal' => $subtotalBahan,
                ]);
            }
        }
    @endphp

    @if($detailBahanRows->isNotEmpty())
        <table class="items-table" style="margin-top: -10px;">
            <thead>
                <tr>
                    <th>Bahan</th>
                    <th class="number-col">Harga Satuan</th>
                    <th class="number-col">Jumlah</th>
                    <th class="number-col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailBahanRows as $row)
                    <tr>
                        <td>
                            <div class="product-name">{{ $row['nama'] }}</div>
                        </td>
                        <td class="number-col">Rp. {{ number_format($row['harga'], 0, ',', '.') }}</td>
                        <td class="number-col">{{ $row['qty'] }}</td>
                        <td class="number-col">Rp. {{ number_format($row['subtotal'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <div style="font-size: 12px; color: #64748b; padding-right: 40px;">
                    <p style="margin: 0 0 5px 0; font-weight: 600; color: #475569;">Ketentuan Preorder:</p>
                    <p style="margin: 0;">Pengerjaan pesanan tenun/sulam dilakukan setelah pesanan dikonfirmasi. Estimasi selesai dapat berubah sewaktu-waktu tergantung kerumitan motif dan antrean produksi.</p>
                </div>
            </td>
            <td style="width: 50%; vertical-align: top; text-align: right;">
                <div style="display: inline-block; text-align: left;">
                    <table class="summary-table">
                        <tr>
                            <td class="label">Total Produk</td>
                            <td class="amount">Rp. {{ number_format($transaksi->detailTransaksi->reduce(function ($carry, $dt) {
                                return $carry + (($dt->produk->harga ?? 0) * $dt->jumlah);
                            }, 0), 0, ',', '.') }}</td>
                        </tr>
                        @if($bahanTotal > 0)
                        <tr>
                            <td class="label">Total Bahan</td>
                            <td class="amount">Rp. {{ number_format($bahanTotal, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr class="grand-total-row">
                            <td class="label">Total Pembayaran</td>
                            <td class="amount">Rp. {{ number_format(($grandTotal ?? 0) + $bahanTotal, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih telah melakukan pemesanan di toko kami!</p>
        <p>Struk ini merupakan bukti pemesanan preorder yang sah.</p>
    </div>

</body>
</html>
