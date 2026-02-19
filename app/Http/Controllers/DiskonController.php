<?php

namespace App\Http\Controllers;
use App\Models\Barang;

use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        return view('diskon');
    }

    public function hitungDiskon(Request $request)
    {
        // Validasi input
        $request->validate([
            'harga' => 'required|numeric|min:1',
            'diskon' => 'required|numeric|min:0|max:100',
        ]);

        // Ambil input
        $harga = $request->input('harga');
        $diskon = $request->input('diskon');

        // Hitung diskon
        $jumlahDiskon = $harga * ($diskon / 100);
        $totalHarga = $harga - $jumlahDiskon;

        // Kirim hasil ke tampilan
        return view('diskon', compact('harga', 'diskon', 'jumlahDiskon', 'totalHarga'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('diskon.hitung', compact('barang'));
    }
    
    public function proses(Request $request, $id)
{
    $request->validate([
        'diskon' => 'required|numeric|min:0|max:100',
    ]);

    $barang = Barang::findOrFail($id);
    $diskon = $request->diskon;
    $potongan = ($barang->harga_barang * $diskon) / 100;
    $total_harga = $barang->harga_barang - $potongan;

    return view('diskon.hasil', compact('barang', 'diskon', 'potongan', 'total_harga'));
}

public function simpan(Request $request, $id)
{
    $barang = Barang::findOrFail($id);
    
    // Validasi input
    $request->validate([
        'diskon' => 'required|numeric|min:0|max:100',
        'total_harga' => 'required|numeric|min:0',
    ]);

    // Simpan harga setelah diskon
    $barang->harga_setelah_diskon = $request->total_harga;
    $barang->save();

    return redirect()->route('barang.index')->with('success', 'Harga setelah diskon berhasil disimpan.');
}

}