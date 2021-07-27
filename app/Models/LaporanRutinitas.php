<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanRutinitas extends Model
{
    use HasFactory;

    protected $table = 'laporan_rutinitas';
    protected $fillable = [
        'rutinitas_id', 'keterangan', 'picturePath', 'status_laporan'
    ];

    public function rutinitas()
    {
        return $this->belongsTo(Rutinitas::class, 'rutinitas_id', 'id');
    }

}
