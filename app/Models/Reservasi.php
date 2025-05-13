<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $fillable = [
        'user_id',
        'meja_id',
        'dari',
        'sampai',
        'status_reservasi'
    ];
}
