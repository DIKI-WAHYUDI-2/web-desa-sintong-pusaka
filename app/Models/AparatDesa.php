<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AparatDesa extends Model
{
    use HasFactory;

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
