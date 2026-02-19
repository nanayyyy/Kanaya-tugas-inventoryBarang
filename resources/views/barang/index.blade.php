<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f2f5;
            padding-bottom: 15px;
        }
        h2 {
            margin: 0;
            font-weight: 600;
            color: #1a202c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #f0f2f5;
        }
        td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #f0f2f5;
            font-size: 14px;
            vertical-align: middle;
        }
        tr:hover {
            background-color: #fdfdfd;
        }
        /* Style Gambar */
        .img-container img {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #eee;
        }
        /* Badge Stok */
        .badge-stok {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        /* Tombol - Tombol */
        .btn {
            padding: 8px 14px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .btn-tambah { background: #4f46e5; color: white; padding: 10px 20px; }
        .btn-tambah:hover { background: #4338ca; transform: translateY(-2px); }

        .btn-edit { background: #fef3c7; color: #92400e; margin-right: 5px; }
        .btn-edit:hover { background: #fde68a; }

        .btn-hapus { background: #fee2e2; color: #b91c1c; }
        .btn-hapus:hover { background: #fecaca; }

        .btn-diskon { background: #ecfdf5; color: #065f46; margin-top: 5px; display: block; text-align: center; }
        .btn-diskon:hover { background: #d1fae5; }

        .btn-keranjang { 
            background: #4f46e5; 
            color: white; 
            width: 100%; 
            margin-top: 8px;
        }
        .btn-keranjang:hover { background: #3730a3; }

        .action-group {
            min-width: 180px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <h2>📦 Daftar Inventaris Barang</h2>
        <a href="{{ route('barang.create') }}" class="btn btn-tambah">+ Tambah Barang</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Normal</th>
                <th>Setelah Diskon</th>
                <th>Stok</th>
                <th>Preview</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
            <tr>
                <td><strong>{{ $barang->nama_barang }}</strong></td>
                <td style="color: #64748b;">Rp{{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                <td>
                    @if ($barang->harga_setelah_diskon)
                        <span style="color: #059669; font-weight: 600;">
                            Rp{{ number_format($barang->harga_setelah_diskon, 0, ',', '.') }}
                        </span>
                    @else
                        <span style="color: #ef4444; font-size: 12px; font-style: italic;">Belum dihitung</span>
                    @endif
                </td>
                <td><span class="badge-stok">{{ $barang->stok }} Qty</span></td>
                <td>
                    <div class="img-container">
                        @if ($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="foto">
                        @else
                            <span style="color: #ccc; font-size: 11px;">No Image</span>
                        @endif
                    </div>
                </td>
                <td class="action-group">
                    <div style="display: flex; margin-bottom: 5px;">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-hapus" onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                        </form>
                    </div>

                    <a href="{{ route('diskon.hitung', ['id' => $barang->id]) }}" class="btn btn-diskon">🏷️ Hitung Diskon</a>

                    <form action="{{ route('keranjang.add', ['id' => $barang->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-keranjang">🛒 Ke Keranjang</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>