<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskripsiPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'deskripsi_perusahaans';
    protected $fillable = [
        'perusahaan_id', 'judul_deskripsi', 'isi_deskripsi'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');
    }
}
