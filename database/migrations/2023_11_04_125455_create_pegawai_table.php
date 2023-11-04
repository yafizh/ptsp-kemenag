<?php

use App\Enums\Pegawai\PegawaiJabatan;
use App\Enums\Pegawai\PegawaiJenisKelamin;
use App\Enums\PendidikanTerakhir;
use App\Models\Pegawai;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new Pegawai)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->enum('jabatan', array_column(PegawaiJabatan::cases(), 'value'));
            $table->enum('jenis_kelamin', array_column(PegawaiJenisKelamin::cases(), 'value'));
            $table->string('nomor_telepon')->unique();
            $table->enum('pendidikan_terakhir', array_column(PendidikanTerakhir::cases(), 'value'));
            $table->date('tmt');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('file_foto');
            $table->string('file_ijazah');
            $table->string('file_sk_pengangkatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Pegawai)->getTable());
    }
};
