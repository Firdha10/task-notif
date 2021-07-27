<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    use HasFactory;

    protected $table = 'transaksi_barangs';
    protected $fillable = [
        'kode_transaksi', 'project_id', 'tgl_transaksi', 'status_transaksi'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function barang_project()
    {
       return $this->hasMany(BarangProject::class);
    }
}
