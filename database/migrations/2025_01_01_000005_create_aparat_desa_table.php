<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aparat_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->date('mulai_jabatan');
            $table->date('akhir_jabatan')->nullable();
            $table->boolean('status_aktif')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aparat_desa');
    }
};
