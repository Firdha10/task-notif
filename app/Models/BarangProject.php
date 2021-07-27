<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangProject extends Model
{
    use HasFactory;

    protected $table = 'barang_projects';
    protected $fillable = [
        'barang_id', 'transaksi_barang_id'
    ];
    
    public function barang_perusahaan()
    {
        return $this->belongsTo(BarangPerusahaan::class, 'barang_id', 'id');
    }

    public function transaksi_barang()
    {
        return $this->belongsTo(TransaksiBarang::class, 'transaksi_barang_id', 'id');
    }
}
