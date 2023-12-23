<?php

namespace Database\Seeders\Master;

use App\Models\Master\JenisIzin;
use Illuminate\Database\Seeder;

class JenisIzinSeeder extends Seeder
{
    public function run(): void
    {
        $jenisIzin = [
            'Izin Terlambat',
            'Izin Pulang Cepat',
            'Izin Tidak Masuk'
        ];

        foreach ($jenisIzin as $value) {
            JenisIzin::create([
                'nama' => $value
            ]);
        }
    }
}
