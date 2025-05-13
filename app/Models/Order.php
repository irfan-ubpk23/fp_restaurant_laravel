<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'user_id',
        'nomor_antrian',
        'status_order',
        'keterangan'
    ];
}
