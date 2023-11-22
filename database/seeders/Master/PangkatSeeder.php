<?php

namespace Database\Seeders\Master;

use App\Models\Master\Pangkat;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
{
    public function run(): void
    {
        $pangkat = [
            'Pembina',
            'Penata Muda',
            'Penata TK. I'
        ];
        foreach ($pangkat as $value) {
            Pangkat::create([
                'nama' => $value
            ]);
        }
    }
}
