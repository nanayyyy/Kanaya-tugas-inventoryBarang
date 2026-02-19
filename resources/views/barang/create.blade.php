<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
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
            max-width: 450px;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
        }
        h2 {
            margin-top: 0;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1a202c;
            text-align: center;
        }
        p {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
        }
        label {
            display: block;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 8px;
            color: #475569;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box; /* Biar input tidak lewat batas container */
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        input[type="file"] {
            padding: 8px;
            background: #f8fafc;
            cursor: pointer;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        button {
            flex: 2;
            background: #4f46e5;
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
            background: #4338ca;
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
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            background: #e2e8f0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Tambah Barang</h2>
        <p>Silakan isi detail produk di bawah ini</p>
        
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <label>Nama Produk</label>
            <input type="text" name="nama_barang" placeholder="Contoh: Buku Pemrograman" required>

            <label>Harga Barang (Rp)</label>
            <input type="number" name="harga_barang" placeholder="Masukkan angka saja" required>

            <label>Stok Tersedia</label>
            <input type="number" name="stok" placeholder="Jumlah stok" required>

            <label>Foto Produk</label>
            <input type="file" name="gambar">

            <div class="btn-group">
                <a href="{{ route('barang.index') }}" class="btn-back">Batal</a>
                <button type="submit">Simpan Produk</button>
            </div>
        </form>
    </div>

</body>
</html>