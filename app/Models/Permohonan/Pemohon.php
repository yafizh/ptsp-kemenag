<?php

namespace App\Models\Permohonan;

use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    protected $table = "pemohon";

    protected $fillable = [
        'id_permohonan',
        'nama',
        'nomor_telepon'
    ];

    public function greenAPIPhoneNumber(): string
    {
        if ($this->nomor_telepon[0] == '+')
            return substr($this->nomor_telepon, 1) . "@c.us";

        if ($this->nomor_telepon[0] == '0')
            return "62" . substr($this->nomor_telepon, 1) . "@c.us";
    }
}
