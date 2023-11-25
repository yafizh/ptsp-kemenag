<?php

use App\Models\Pengajuan\JenisPengajuan\PengajuanSPDPBiayaPerjalanDinas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PengajuanSPDPBiayaPerjalanDinas)->getTable(), function (Blueprint $table) {
            $table->foreignId('id_pengajuan_spdp');
            $table->foreignId('id_biaya_perjalanan_dinas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PengajuanSPDPBiayaPerjalanDinas)->getTable());
    }
};
