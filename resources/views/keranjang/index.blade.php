<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
        }
        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        h2 { margin: 0; font-weight: 700; color: #1e293b; }
        
        /* Table Style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            text-align: left;
            padding: 15px;
            background: #f8fafc;
            color: #64748b;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f1f5f9;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        /* Input & Buttons */
        .form-control {
            padding: 8px 12px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            outline: none;
        }
        .form-control:focus { border-color: #4f46e5; }

        .btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            border: none;
        }
        .btn-primary { background: #4f46e5; color: white; }
        .btn-primary:hover { background: #4338ca; }
        
        .btn-warning { background: #fef3c7; color: #92400e; margin-left: 5px; }
        .btn-warning:hover { background: #fde68a; }

        .btn-danger { background: #fee2e2; color: #b91c1c; }
        .btn-danger:hover { background: #fecaca; }

        .btn-success { background: #10b981; color: white; width: 100%; justify-content: center; font-size: 16px; }
        .btn-success:hover { background: #059669; }

        /* Checkout Section */
        .checkout-card {
            background: #f8fafc;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1e293b;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: #64748b;
        }
        .payment-input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .kembalian-box {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 15px;
            display: none; /* Muncul via JS */
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-box">
        <h2>🛒 Keranjang Belanja</h2>
        <a href="{{ route('barang.index') }}" class="btn btn-primary">+ Tambah Barang</a>
    </div>

    @php $total = 0; @endphp
    
    @if(!empty(session('keranjang')))
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th style="width: 180px;">Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('keranjang', []) as $id => $item)
                    @php 
                        $subtotal = $item['harga'] * $item['jumlah']; 
                        $total += $subtotal; 
                    @endphp
                    <tr>
                        <td><strong>{{ $item['nama_barang'] }}</strong></td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('keranjang.update', $id) }}" method="POST" style="display: flex;">
                                @csrf
                                <input type="number" name="jumlah" class="form-control" value="{{ $item['jumlah'] }}" min="1" style="width: 60px;">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </form>
                        </td>
                        <td><strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></td>
                        <td>
                            <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="checkout-card">
            <div class="total-row">
                <span>Total Bayar</span>
                <span style="color: #4f46e5;">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form action="{{ route('keranjang.checkout') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="uang_diberikan">Uang Diberikan (Tunai)</label>
                    <input type="number" id="uang_diberikan" name="uang_diberikan" class="form-control payment-input" placeholder="Masukkan jumlah uang..." required min="1">
                    <button type="button" class="btn btn-primary" style="width: 100%; margin-bottom: 15px;" onclick="hitungKembalian({{ $total }})">🔢 Hitung Kembalian</button>
                </div>

                <div id="kembalian-box" class="kembalian-box"></div>

                <button type="submit" class="btn btn-success">✅ Checkout & Cetak Struk (PDF)</button>
            </form>

            <form action="{{ route('keranjang.reset') }}" method="GET" style="margin-top: 15px; text-align: center;">
                <button type="submit" style="background:none; border:none; color:#94a3b8; cursor:pointer; font-size:13px; text-decoration:underline;">Kosongkan Keranjang</button>
            </form>
        </div>

    @else
        <div class="empty-state">
            <div style="font-size: 50px; margin-bottom: 10px;">🛒</div>
            <p>Keranjang kamu masih kosong nih.</p>
            <a href="{{ route('barang.index') }}" class="btn btn-primary" style="margin-top: 10px;">Mulai Belanja</a>
        </div>
    @endif
</div>

<script>
    function hitungKembalian(totalHarga) {
        let uangDiberikan = document.getElementById('uang_diberikan').value;
        let kembalianBox = document.getElementById('kembalian-box');
        
        kembalianBox.style.display = "block";

        if (uangDiberikan === "" || uangDiberikan <= 0) {
            kembalianBox.innerText = "⚠️ Masukkan uang yang valid!";
            kembalianBox.style.background = "#fee2e2";
            kembalianBox.style.color = "#b91c1c";
            return;
        }

        let kembalian = uangDiberikan - totalHarga;

        if (kembalian < 0) {
            kembalianBox.innerText = "❌ Uang kurang Rp " + new Intl.NumberFormat('id-ID').format(Math.abs(kembalian));
            kembalianBox.style.background = "#fee2e2";
            kembalianBox.style.color = "#b91c1c";
        } else {
            kembalianBox.innerText = "💰 Kembalian: Rp " + new Intl.NumberFormat('id-ID').format(kembalian);
            kembalianBox.style.background = "#ecfdf5";
            kembalianBox.style.color = "#065f46";
        }
    }
</script>
</body>
</html>