<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi PDF</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 12px; 
            color: #333; 
            line-height: 1.4;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 2px solid #002626;
            padding-bottom: 10px;
        }
        .header h2 { 
            margin: 0; 
            color: #004D39; 
            font-size: 20px;
        }
        .header p { 
            margin: 5px 0 0 0; 
            color: #555; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        table th, table td { 
            border: 1px solid #211f1f; 
            padding: 10px 8px; 
            text-align: left; 
        }
        table th { 
             background-color: #008080; 
            font-weight: bold; 
            color: #ffffff;
        }
        .text-right { 
            text-align: right; 
        }
        .text-center {
            text-align: center;
        }
        .total-section { 
            margin-top: 25px; 
            text-align: right; 
            font-size: 14px; 
            font-weight: bold; 
            color: #000;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN TRANSAKSI RISKA SULAM</h2>
        @if($dari_tanggal && $sampai_tanggal)
            <p>Periode: {{ \Carbon\Carbon::parse($dari_tanggal)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($sampai_tanggal)->format('d/m/Y') }}</p>
        @elseif($dari_tanggal)
            <p>Periode: Sejak {{ \Carbon\Carbon::parse($dari_tanggal)->format('d/m/Y') }}</p>
        @elseif($sampai_tanggal)
            <p>Periode: Sampai {{ \Carbon\Carbon::parse($sampai_tanggal)->format('d/m/Y') }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Jenis Transaksi</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
       @foreach($transaksi as $index => $item)
<tr>
    <td class="text-center">{{ $index + 1 }}</td>
    <td>{{ $item->pelanggan->nm_pelanggan ?? 'Umum/Anonim' }}</td>
    <td>{{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d/m/Y') }}</td>
    <td>{{ $item->jenis_transaksi }}</td>
    <td class="text-right">Rp. {{ number_format($item->getAttribute('total_laporan') ?? 0, 0, ',', '.') }}</td>
</tr>
@endforeach
        </tbody>
    </table>

    <div class="total-section">
        Total Keseluruhan : Rp. {{ number_format($total_keseluruhan, 0, ',', '.') }}
    </div>

</body>
</html>