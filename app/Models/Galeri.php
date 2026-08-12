<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'kategori',
        'organisasi'
    ];

    public function fotos()
    {
        return $this->hasMany(GaleriFoto::class);
    }
}
