<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric|min:1',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $request->file('gambar') ? $request->file('gambar')->store('public/gambar') : null;

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stok' => $request->stok,
            'gambar' => $gambarPath ? str_replace('public/', '', $gambarPath) : null,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric|min:1',
            'stok' => 'required|numeric|min:0',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('gambar')) {
            if ($barang->gambar) {
                Storage::delete('public/' . $barang->gambar);
            }
            $gambarPath = $request->file('gambar')->store('public/gambar');
            $barang->gambar = str_replace('public/', '', $gambarPath);
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
