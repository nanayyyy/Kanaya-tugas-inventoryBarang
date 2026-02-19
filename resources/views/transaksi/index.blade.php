<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
            color: #1e293b;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        h2 { margin: 0; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 10px; }
        
        .btn-back {
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            background: #f1f5f9;
            color: #475569;
            transition: 0.3s;
        }
        .btn-back:hover { background: #e2e8f0; }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }
        th {
            background-color: #f8fafc;
            color: #64748b;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #f1f5f9;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
        }
        tr:hover { background-color: #fcfcfd; }

        /* Status & Text Styling */
        .text-bold { font-weight: 600; color: #0f172a; }
        .text-muted { color: #94a3b8; font-size: 12px; }
        .price-total { color: #059669; font-weight: 700; }
        .badge-date {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }
        .qty-circle {
            background: #f1f5f9;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2><span>📑</span> Riwayat Transaksi</h2>
        <a href="{{ route('barang.index') }}" class="btn-back">← Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal & Waktu</th>
                <th>Nama Barang</th>
                <th style="text-align: center;">Jumlah</th>
                <th>Total Harga</th>
                <th>Bayar / Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
            <tr>
                <td>
                    <span class="badge-date">{{ $transaksi->created_at->format('d M Y') }}</span><br>
                    <span class="text-muted">{{ $transaksi->created_at->format('H:i') }} WIB</span>
                </td>
                <td>
                    <span class="text-bold">{{ $transaksi->barang->nama_barang }}</span>
                </td>
                <td style="text-align: center;">
                    <span class="qty-circle">{{ $transaksi->jumlah }}</span>
                </td>
                <td>
                    <span class="price-total">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                </td>
                <td>
                    <div style="font-size: 13px;">
                        <span class="text-muted">Bayar:</span> Rp{{ number_format($transaksi->uang_diberikan, 0, ',', '.') }}<br>
                        <span class="text-muted">Kembali:</span> Rp{{ number_format($transaksi->kembalian, 0, ',', '.') }}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($transaksis->isEmpty())
        <div style="text-align: center; padding: 40px; color: #94a3b8;">
            <p>Belum ada transaksi yang tercatat.</p>
        </div>
    @endif
</div>

</body>
</html>