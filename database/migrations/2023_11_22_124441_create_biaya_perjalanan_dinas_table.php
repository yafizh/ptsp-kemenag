<?php

use App\Models\Master\BiayaPerjalananDinas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new BiayaPerjalananDinas)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('tingkat');
            $table->string('range_dari');
            $table->string('range_sampai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new BiayaPerjalananDinas)->getTable());
    }
};
