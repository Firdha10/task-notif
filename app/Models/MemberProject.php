<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProject extends Model
{
    use HasFactory;

    protected $table = 'member_perusahaans';
    protected $fillable = [
        'project_id', 'member_perusahaan_id', 'type_user'
    ];

    public function member_perusahaan()
    {
        return $this->belongsTo(MemberPerusahaan::class,'member_perusahaan_id','id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function tugas_project(){
        return $this->hasMany(TugasProject::class);
    }
}
