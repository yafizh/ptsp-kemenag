<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $fillable = [
        'nama_file',
        'nama_file_asli'
    ];

    protected $table = 'upload_file';
}
