<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs'; // Pastikan sesuai dengan nama tabel di database
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'harga_setelah_diskon',
        'stok',
        'gambar',
    ];
}
