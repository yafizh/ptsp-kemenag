<?php

use App\Models\UploadFile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new UploadFile)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->string('nama_file_asli');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new UploadFile)->getTable());
    }
};
