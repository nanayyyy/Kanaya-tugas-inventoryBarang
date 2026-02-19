<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #28a745; color: white; }
        .total-section { margin-top: 20px; font-size: 18px; }
        .total-section span { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Struk Pembayaran</h2>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        @foreach ($keranjang as $item)
        <tr>
            <td>{{ $item['nama_barang'] }}</td>
            <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
            <td>{{ $item['jumlah'] }}</td>
            <td>Rp{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="total-section">
        <p><strong>Total Harga:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
        <p><strong>Uang Diberikan:</strong> Rp{{ number_format($uangDiberikan, 0, ',', '.') }}</p>
        <p><strong>Kembalian:</strong> Rp{{ number_format($kembalian, 0, ',', '.') }}</p>
    </div>
    
    <p>Terima kasih telah berbelanja!</p>
</body>
</html>
