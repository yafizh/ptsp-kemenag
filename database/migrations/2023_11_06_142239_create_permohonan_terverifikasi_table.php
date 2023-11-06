<?php

use App\Enums\Permohonan\PermohonanStatus;
use App\Models\Permohonan\PermohonanTerverifikasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PermohonanTerverifikasi)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan');
            $table->foreignId('id_pengguna');
            $table->date('tanggal_verifikasi');
            $table->text('keterangan');
            $table->enum('status', array_column(PermohonanStatus::cases(), 'value'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PermohonanTerverifikasi)->getTable());
    }
};
