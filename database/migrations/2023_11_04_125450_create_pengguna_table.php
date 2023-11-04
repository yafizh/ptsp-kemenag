<?php

use App\Enums\User\UserStatus;
use App\Models\Pengguna;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create((new Pengguna)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('status', UserStatus::cases());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists((new Pengguna)->getTable());
    }
};
