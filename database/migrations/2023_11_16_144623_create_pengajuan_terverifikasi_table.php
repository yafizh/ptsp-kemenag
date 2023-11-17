<?php

use App\Enums\Pengajuan\PengajuanStatus;
use App\Models\Pengajuan\PengajuanTerverifikasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PengajuanTerverifikasi)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan');
            $table->foreignId('id_pengguna');
            $table->dateTime('tanggal_waktu_verifikasi');
            $table->text('keterangan');
            $table->enum('status', array_column(PengajuanStatus::cases(), 'value'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PengajuanTerverifikasi)->getTable());
    }
};
