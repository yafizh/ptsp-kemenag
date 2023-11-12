<?php

namespace Database\Seeders;

use App\Models\Master\JenisCuti;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    public function run(): void
    {
        $jenisCuti = [
            'Cuti Melahirkan',
            'Cuti Istri Melahirkan',
            'Cuti Tahunan',
            'Cuti Wisuda',
            'Cuti Menikah'
        ];
        foreach ($jenisCuti as $value) {
            JenisCuti::create([
                'nama' => $value
            ]);
        }
    }
}
