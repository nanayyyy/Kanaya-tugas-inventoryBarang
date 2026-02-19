<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Diskon</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.07);
            text-align: center;
        }
        .success-icon {
            color: #10b981;
            font-size: 48px;
            margin-bottom: 15px;
        }
        h2 {
            margin: 0 0 10px;
            font-weight: 700;
            color: #1e293b;
        }
        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }
        
        /* Ringkasan Hasil */
        .result-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }
        .result-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 15px;
        }
        .result-item:last-child {
            border-bottom: none;
            padding-top: 15px;
            margin-top: 5px;
        }
        .label { color: #64748b; }
        .value { font-weight: 600; color: #1e293b; }
        
        /* Total Harga Highlight */
        .total-label { font-weight: 700; color: #1e293b; font-size: 16px; }
        .total-value { font-weight: 700; color: #059669; font-size: 18px; }

        /* Button Styling */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        button, .btn-link {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            text-decoration: none;
            box-sizing: border-box;
            display: block;
        }
        .btn-save {
            background: #10b981;
            color: white;
        }
        .btn-save:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
        }
        .btn-back {
            background: #f1f5f9;
            color: #475569;
        }
        .btn-back:hover {
            background: #e2e8f0;
            color: #1e293b;
        }
        
        .badge-discount {
            background: #fee2e2;
            color: #dc2626;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="success-icon">✨</div>
        <h2>Hasil Perhitungan</h2>
        <p class="subtitle">Detail potongan harga untuk produk Anda</p>
        
        <div class="result-card">
            <div class="result-item">
                <span class="label">Nama Barang</span>
                <span class="value">{{ $barang->nama_barang }}</span>
            </div>
            <div class="result-item">
                <span class="label">Harga Asli</span>
                <span class="value">Rp{{ number_format($barang->harga_barang, 0, ',', '.') }}</span>
            </div>
            <div class="result-item">
                <span class="label">Diskon</span>
                <span class="value"><span class="badge-discount">{{ $diskon }}% OFF</span></span>
            </div>
            <div class="result-item">
                <span class="label">Potongan</span>
                <span class="value" style="color: #dc2626;">- Rp{{ number_format($potongan, 0, ',', '.') }}</span>
            </div>
            <div class="result-item">
                <span class="total-label">Harga Akhir</span>
                <span class="total-value">Rp{{ number_format($total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="btn-group">
            <form action="{{ route('diskon.simpan', $barang->id) }}" method="POST">
                @csrf
                <input type="hidden" name="diskon" value="{{ $diskon }}">
                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                <button type="submit" class="btn-save">💾 Simpan Harga Diskon</button>
            </form>

            <a href="{{ route('barang.index') }}" class="btn-back"> Kembali ke Daftar</a>
        </div>
    </div>

</body>
</html>