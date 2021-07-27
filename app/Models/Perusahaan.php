<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;


    protected $table = "perusahaans";
    protected $fillable = [
        'nama_perusahaan', 'picture_path','kontak_perusahaan'
    ];

    public function getPicturePathAttribute($value)
    {
        if($value){
            return asset("perusahaan/".$value);
        }
        return null;
    }
    
    public function deskripsi()
    {
        return $this->hasMany(Deskripsi::class);
    }

    public function barang(){
        return $this->hasMany(Barang::class);
    }

    public function member_perusahaan()
    {
       return $this->hasMany(MemberPerusahaan::class);
    }

    public function project(){
        return $this->hasMany(Project::class);
    }
}
