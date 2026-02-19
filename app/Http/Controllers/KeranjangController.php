<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Barang;

class KeranjangController extends Controller
{
    // Tambah barang ke keranjang
    public function addToCart($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        // Cek apakah barang sudah ada di keranjang
        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'nama_barang' => $barang->nama_barang,
                'harga' => $barang->harga_setelah_diskon ?? $barang->harga_barang,
                'jumlah' => 1
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')->with('success', 'Barang ditambahkan ke keranjang!');
    }

    // Tampilkan halaman keranjang
    public function index()
    {
        $keranjang = session('keranjang', []);
        return view('keranjang.index', compact('keranjang'));
    }

    public function show()
{
    $keranjang = session('keranjang', []);
    return view('keranjang.index', compact('keranjang'));
}


    // Hapus item dari keranjang
    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]); // Hapus item dari array session
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('keranjang.index')->with('success', 'Barang dihapus dari keranjang!');
    }

    // Update jumlah barang di keranjang
    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] = $request->jumlah;
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('keranjang.index')->with('success', 'Jumlah barang diperbarui!');
    }

    public function checkout(Request $request)
{
    $request->validate([
        'uang_diberikan' => 'required|numeric|min:1',
    ]);

    $keranjang = session('keranjang', []);
    if (empty($keranjang)) {
        return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong! Tambahkan barang terlebih dahulu.');
    }

    $totalHarga = array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $keranjang));
    $uangDiberikan = $request->input('uang_diberikan');

    if ($uangDiberikan < $totalHarga) {
        return redirect()->route('keranjang.index')->with('error', 'Uang yang diberikan kurang dari total harga!');
    }

    $kembalian = $uangDiberikan - $totalHarga;

    // Kurangi stok barang
    foreach ($keranjang as $id => $item) {
        $barang = Barang::find($id);
        if ($barang) {
            $barang->stok -= $item['jumlah'];
            $barang->save();
        }
    }

    // Buat PDF struk pembayaran
    $pdf = PDF::loadView('keranjang.pdf', compact('keranjang', 'totalHarga', 'uangDiberikan', 'kembalian'));

    // Hapus keranjang setelah cetak PDF
    session()->forget('keranjang');

    return $pdf->download('struk_pembayaran.pdf');
}



    // Cetak PDF dengan input uang yang diberikan
    public function cetak(Request $request)
    {
        $request->validate([
            'uang_diberikan' => 'required|numeric|min:1',
        ]);

        $keranjang = session('keranjang', []);
        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong! Tidak ada yang dicetak.');
        }

        $totalHarga = array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $keranjang));

        if ($request->uang_diberikan < $totalHarga) {
            return redirect()->route('keranjang.index')->with('error', 'Uang yang diberikan kurang dari total harga!');
        }

        $kembalian = $request->uang_diberikan - $totalHarga;

        // Buat PDF
        $pdf = PDF::loadView('keranjang.pdf', compact('keranjang', 'totalHarga', 'kembalian', 'uangDiberikan'));

        // Hapus keranjang setelah cetak PDF
        session()->forget('keranjang');

        return $pdf->download('struk_pembayaran.pdf');
    }

    // Hapus semua isi keranjang
    public function resetKeranjang()
    {
        session()->forget('keranjang');
        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }
}
