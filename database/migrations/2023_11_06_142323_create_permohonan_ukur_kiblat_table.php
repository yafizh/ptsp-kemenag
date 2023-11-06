<?php

use App\Models\Permohonan\JenisPermohonan\PermohonanUkurKiblat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PermohonanUkurKiblat)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan');
            $table->string('nama_ketua');
            $table->string('nomor_telepon_ketua');
            $table->string('nama_rumah_ibadah');
            $table->string('alamat_rumah_ibadah');
            $table->string('nomor_telepon_rumah_ibadah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PermohonanUkurKiblat)->getTable());
    }
};
