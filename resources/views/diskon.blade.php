<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        button:hover {
            background: #218838;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #dff0d8;
            color: #155724;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Perhitungan Diskon</h2>

        <form action="{{ url('/hitung-diskon') }}" method="POST">
            @csrf
            <label for="harga">Harga Barang:</label>
            <input type="number" name="harga" required>

            <label for="diskon">Persentase Diskon (%):</label>
            <input type="number" name="diskon" required>

            <button type="submit">Hitung</button>
        </form>

        @if(isset($totalHarga))
            <div class="result">
                <h3>Hasil Perhitungan</h3>
                <p><strong>Harga Awal:</strong> Rp{{ number_format($harga, 0, ',', '.') }}</p>
                <p><strong>Diskon:</strong> {{ $diskon }}% (Rp{{ number_format($jumlahDiskon, 0, ',', '.') }})</p>
                <p><strong>Total Harga Setelah Diskon:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
            </div>
        @endif
    </div>

</body>
</html>
