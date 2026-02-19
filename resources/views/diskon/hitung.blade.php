<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon - {{ $barang->nama_barang }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
            max-width: 420px;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
        }
        .icon-box {
            background: #ecfdf5;
            color: #059669;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
        }
        h2 {
            margin: 0 0 20px;
            font-weight: 600;
            color: #1a202c;
            text-align: center;
        }
        .info-card {
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .info-item:last-child { margin-bottom: 0; }
        .label-text { color: #64748b; }
        .value-text { font-weight: 600; color: #1e293b; }

        label {
            display: block;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 8px;
            color: #475569;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 16px;
            transition: all 0.2s ease;
            text-align: center;
        }
        input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        button {
            flex: 2;
            background: #10b981;
            color: white;
            border: none;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        button:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        .btn-back {
            flex: 1;
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            text-align: center;
            padding: 14px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-back:hover { background: #e2e8f0; }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon-box">🏷️</div>
        <h2>Hitung Diskon</h2>
        
        <div class="info-card">
            <div class="info-item">
                <span class="label-text">Nama Barang</span>
                <span class="value-text">{{ $barang->nama_barang }}</span>
            </div>
            <div class="info-item">
                <span class="label-text">Harga Normal</span>
                <span class="value-text">Rp{{ number_format($barang->harga_barang, 0, ',', '.') }}</span>
            </div>
        </div>

        <form action="{{ route('diskon.proses', $barang->id) }}" method="POST">
            @csrf
            <label>Masukkan Persentase (%)</label>
            <input type="number" name="diskon" min="0" max="100" placeholder="0 - 100" required autofocus>

            <div class="btn-group">
                <a href="{{ route('barang.index') }}" class="btn-back">Batal</a>
                <button type="submit">Proses Diskon</button>
            </div>
        </form>
    </div>

</body>
</html>