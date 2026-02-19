<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index() {
        $transaksis = Transaksi::with('barang')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function store(Request $request, $id) {
        $barang = Barang::findOrFail($id);
    
        // Gunakan harga setelah diskon jika ada, jika tidak gunakan harga asli
        $harga = $barang->harga_setelah_diskon ?? $barang->harga_barang;
        $uang_diberikan = $request->uang_diberikan;
    
        // Validasi agar uang diberikan harus lebih besar atau sama dengan total harga
        if ($uang_diberikan < $harga) {
            return redirect()->back()->with('error', 'Uang yang diberikan kurang!');
        }
    
        $kembalian = $uang_diberikan - $harga;
    
        // Simpan transaksi
        Transaksi::create([
            'barang_id' => $barang->id,
            'jumlah' => 1, // Default 1 barang, bisa dikembangkan nanti
            'total_harga' => $harga,
            'uang_diberikan' => $uang_diberikan,
            'kembalian' => $kembalian
        ]);
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil!');
    }
    
}
