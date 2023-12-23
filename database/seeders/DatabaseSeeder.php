<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\User\UserStatus;
use App\Models\Pengguna;
use Database\Seeders\Master\BiayaPerjalananDinasSeeder;
use Database\Seeders\Master\GolonganSeeder;
use Database\Seeders\Master\JabatanSeeder;
use Database\Seeders\Master\JenisCutiSeeder;
use Database\Seeders\Master\JenisKendaraanSeeder;
use Database\Seeders\Master\PangkatSeeder;
use Database\Seeders\Master\RumahIbadahSeeder;
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
            PangkatSeeder::class,
            GolonganSeeder::class,
            JabatanSeeder::class,
            RumahIbadahSeeder::class,
            JenisCutiSeeder::class,
            JenisKendaraanSeeder::class,
            BiayaPerjalananDinasSeeder::class
        ]);
    }
}
