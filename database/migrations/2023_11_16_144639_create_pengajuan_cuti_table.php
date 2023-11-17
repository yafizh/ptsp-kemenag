<?php

use App\Models\Pengajuan\JenisPengajuan\PengajuanCuti;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PengajuanCuti)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_cuti');
            $table->foreignId('id_pengajuan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PengajuanCuti)->getTable());
    }
};
