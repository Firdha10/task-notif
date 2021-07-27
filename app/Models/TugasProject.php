<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasProject extends Model
{
    use HasFactory;

    protected $table = 'tugas_projects';
    protected $fillable = [
        'project_id', 'nama_tugas', 'stat', 'tanggal_mulai', 'tanggal_selesai', 'member_project_id', 'status_tugas'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function member_project()
    {
        return $this->belongsTo(MemberProject::class, 'member_project_id', 'id');
    }
}
