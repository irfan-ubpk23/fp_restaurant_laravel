<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'meja';
    protected $fillable = [
        'nama_meja',
        'batas_orang',
        'status_meja'
    ];
}
