<?php

namespace Database\Seeders\Master;

use App\Models\Master\BiayaPerjalananDinas;
use Illuminate\Database\Seeder;

class BiayaPerjalananDinasSeeder extends Seeder
{
    public function run(): void
    {
        $biayaPerjalananDinas = [
            [
                'tingkat' => 'A',
                'range_dari' => 5_000_000,
                'range_sampai' => 10_000_000
            ],
            [
                'tingkat' => 'B',
                'range_dari' => 4_000_000,
                'range_sampai' => 5_000_000
            ],
            [
                'tingkat' => 'C',
                'range_dari' => 3_000_000,
                'range_sampai' => 4_000_000
            ],
            [
                'tingkat' => 'D',
                'range_dari' => 2_000_000,
                'range_sampai' => 3_000_000
            ],
            [
                'tingkat' => 'E',
                'range_dari' => 1_000_000,
                'range_sampai' => 2_000_000
            ],
            [
                'tingkat' => 'F',
                'range_dari' => 0,
                'range_sampai' => 1_000_000
            ],
        ];

        foreach ($biayaPerjalananDinas as $value) {
            BiayaPerjalananDinas::create([
                'tingkat'       => $value['tingkat'],
                'range_dari'    => $value['range_dari'],
                'range_sampai'  => $value['range_sampai'],
            ]);
        }
    }
}
