<?php

use App\Models\Pengajuan\JenisPengajuan\PengajuanIzin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PengajuanIzin)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_izin');
            $table->foreignId('id_pengajuan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PengajuanIzin)->getTable());
    }
};
