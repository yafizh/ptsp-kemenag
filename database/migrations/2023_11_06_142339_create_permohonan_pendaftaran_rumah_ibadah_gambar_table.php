<?php

use App\Models\Permohonan\JenisPermohonan\PermohonanPendaftaranRumahIbadah;
use App\Models\Permohonan\JenisPermohonan\PermohonanPendaftaranRumahIbadahGambar;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PermohonanPendaftaranRumahIbadahGambar)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan_pendaftaran_rumah_ibadah');
            $table->string('nama_file');
            $table->string('nama_file_asli');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PermohonanPendaftaranRumahIbadahGambar)->getTable());
    }
};
