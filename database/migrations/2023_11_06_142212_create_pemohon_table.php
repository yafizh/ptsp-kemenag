<?php

use App\Models\Permohonan\Pemohon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new Pemohon)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permohonan');
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Pemohon)->getTable());
    }
};
