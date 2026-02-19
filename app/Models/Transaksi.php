<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['barang_id', 'jumlah', 'total_harga', 'uang_diberikan', 'kembalian'];


    public function barang() {
        return $this->belongsTo(Barang::class);
    }
}
