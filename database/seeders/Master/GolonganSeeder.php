<?php

namespace Database\Seeders\Master;

use App\Models\Master\Golongan;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    public function run(): void
    {
        $golongan = [
            'III/a',
            'III/b',
            'III/d'
        ];
        foreach ($golongan as $value) {
            Golongan::create([
                'nama' => $value
            ]);
        }
    }
}
