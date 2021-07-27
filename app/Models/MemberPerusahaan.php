<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'member_perusahaans';
    protected $fillable = [
        'user_id', 'perusahaan_id', 'type_user'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class,'perusahaan_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function member_project()
    {
        return $this->hasMany(MemberProject::class);
    }

    public function rutinitas()
    {
        return $this->hasMany(MemberPerusahaan::class);
    }
}
