<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AparatDesa extends Model
{
    protected $table = 'aparat_desa';
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'mulai_jabatan',
        'akhir_jabatan',
        'status_aktif',
    ];

    public $timestamps = false;
}
