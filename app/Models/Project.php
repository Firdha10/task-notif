<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';
    protected $fillable = [
        'nama_project', 'desc', 'long_desc', 'tanggal_mulai', 'tanggal_akhir', 'perusahaan_id', 'status_project', 'status_pengerjaan'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');
    }

    public function member_project()
    {
        return $this->hasMany(MemberProject::class);
    }

    public function tugas_project()
    {
        return $this->hasMany(TugasProject::class);
    }

    public function file_project()
    {
        return $this->hasMany(FileProject::class);
    }

    public function transaksi_barang()
    {
        return $this->hasMany(TransaksiBarang::class);
    }

    
}
