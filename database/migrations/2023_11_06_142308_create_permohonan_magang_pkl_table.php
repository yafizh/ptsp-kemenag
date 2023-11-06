<?php

use App\Models\Permohonan\JenisPermohonan\PermohonanMagangPKL;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PermohonanMagangPKL)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan');
            $table->string('nama');
            $table->string('asal_sekolah');
            $table->string('alamat_sekolah');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PermohonanMagangPKL)->getTable());
    }
};
