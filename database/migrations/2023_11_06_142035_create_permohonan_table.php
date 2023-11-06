<?php

use App\Models\Permohonan\Permohonan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new Permohonan)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_permohonan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Permohonan)->getTable());
    }
};
