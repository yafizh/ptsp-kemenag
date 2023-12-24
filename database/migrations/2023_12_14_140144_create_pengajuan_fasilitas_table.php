<?php

use App\Models\Pengajuan\JenisPengajuan\PengajuanFasilitas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PengajuanFasilitas)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan');
            $table->string('fasilitas');
            $table->text('keperluan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PengajuanFasilitas)->getTable());
    }
};
