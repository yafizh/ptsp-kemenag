<?php

namespace Database\Seeders\Master;

use App\Models\Master\JenisKendaraan;
use Illuminate\Database\Seeder;

class JenisKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $jenisKendaraan = [
            'Mobil Pribadi',
            'Motor Pribadi',
            'Angkutan Umum',
            'Mobil Kantor',
            'Motor Kantor'
        ];
        foreach ($jenisKendaraan as $value) {
            JenisKendaraan::create([
                'nama' => $value
            ]);
        }
    }
}
