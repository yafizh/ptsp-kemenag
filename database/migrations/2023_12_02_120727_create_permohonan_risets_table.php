<?php

use App\Models\Permohonan\JenisPermohonan\PermohonanRiset;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PermohonanRiset)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan');
            $table->string('asal_instansi');
            $table->text('keperluan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PermohonanRiset)->getTable());
    }
};
