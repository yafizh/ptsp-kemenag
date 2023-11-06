<?php

namespace Database\Seeders;

use App\Models\Master\RumahIbadah;
use Illuminate\Database\Seeder;

class RumahIbadahSeeder extends Seeder
{
    public function run(): void
    {
        $rumahIbadah = [
            'Masjid',
            'Gereja',
            'Pura',
            'Vihara'
        ];
        foreach ($rumahIbadah as $value) {
            RumahIbadah::create([
                'nama' => $value
            ]);
        }
    }
}
