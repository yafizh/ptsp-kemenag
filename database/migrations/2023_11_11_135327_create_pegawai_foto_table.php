<?php

use App\Models\Pegawai\PegawaiFoto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new PegawaiFoto)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pegawai');
            $table->string('nama_file');
            $table->string('nama_file_asli');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new PegawaiFoto)->getTable());
    }
};
