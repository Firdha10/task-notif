<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $fillable = [
        'nama_barang', 'stok_barang', 'status_barang', 'jenis_barang', 'picture_path','perusahaan_id'
    ];

    public function getPicturePathAttribute($value)
    {
        if($value){
            return asset("perusahaan/".$value);
        }
        return null;
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');
    }

    public function barang_project()
    {
        return $this->hasMany(BarangProject::class);
    }
}
