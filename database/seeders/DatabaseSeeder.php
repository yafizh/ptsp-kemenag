<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\User\UserStatus;
use App\Models\Pengguna;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::create([
            'username' => 'admin',
            'password' => 1,
            'status' => UserStatus::ADMIN
        ]);

        $this->call([
            RumahIbadahSeeder::class,
            JenisCutiSeeder::class,
            JenisKendaraanSeeder::class,
        ]);
    }
}
