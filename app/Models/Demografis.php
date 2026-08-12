<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demografis extends Model
{
    use HasFactory;

    protected $table = 'demografis';

    protected $fillable = [
        'jumlah_dusun',
        'jumlah_rw',
        'jumlah_rt',
        'jumlah_keluarga',
        'jumlah_penduduk',
        'kepadatan_penduduk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'luas_perkebunan_sawit',
    ];
    public $timestamps = false;
}
