<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_fotos';
    protected $fillable = ['galeri_id', 'gambar'];
    public $timestamps = false;

    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
