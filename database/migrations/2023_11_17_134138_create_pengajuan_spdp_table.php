<?php

use App\Models\Pengajuan\JenisPengajuan\PengajuanSPDP;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PengajuanSPDP)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_kendaraan');
            $table->foreignId('id_pengajuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->string('tempat_berangkat');
            $table->string('tempat_tujuan');
            $table->text('maksud_perjalanan_dinas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PengajuanSPDP)->getTable());
    }
};
