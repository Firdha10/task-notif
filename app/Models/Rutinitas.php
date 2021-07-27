<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutinitas extends Model
{
    use HasFactory;

    protected $table = 'rutinitas';
    protected $fillable = [
        'nama_rutinitas', 'stat', 'jam', 'tanggal_mulai', 'tanggal_akhir', 'member_perusahaan_id', 'status_rutinitas'
    ];

    public function member_perusahaan()
    {
        return $this->belongsTo(MemberPerusahaan::class, 'member_perusahaan_id', 'id');
    }

}
