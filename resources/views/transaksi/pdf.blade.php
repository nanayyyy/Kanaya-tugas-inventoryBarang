<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #28a745; color: white; }
    </style>
</head>
<body>
    <h2>Struk Transaksi</h2>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        @foreach ($keranjang as $item)
        <tr>
            <td>{{ $item->barang->nama_barang }}</td>
            <td>Rp{{ number_format($item->barang->harga_setelah_diskon ?? $item->barang->harga_barang, 0, ',', '.') }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp{{ number_format(($item->barang->harga_setelah_diskon ?? $item->barang->harga_barang) * $item->jumlah, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    <h3>Total Harga: Rp{{ number_format($totalHarga, 0, ',', '.') }}</h3>
    <h3>Uang Diberikan: Rp{{ number_format($uangDiberikan, 0, ',', '.') }}</h3>
    <h3>Kembalian: Rp{{ number_format($kembalian, 0, ',', '.') }}</h3>
</body>
</html>
