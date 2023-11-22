<?php

namespace Database\Seeders\Master;

use App\Models\Master\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $golongan = [
            'Kepala Kemenag',
            'Kabag TU'
        ];
        foreach ($golongan as $value) {
            Jabatan::create([
                'nama' => $value
            ]);
        }
    }
}
