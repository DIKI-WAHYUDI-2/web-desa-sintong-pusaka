<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demografis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('jumlah_dusun');
            $table->unsignedInteger('jumlah_rw');
            $table->unsignedInteger('jumlah_rt');
            $table->unsignedInteger('jumlah_keluarga');
            $table->unsignedInteger('jumlah_penduduk');
            $table->decimal('kepadatan_penduduk', 10, 2);
            $table->unsignedInteger('jumlah_laki_laki');
            $table->unsignedInteger('jumlah_perempuan');
            $table->decimal('luas_perkebunan_sawit', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demografis');
    }
};
