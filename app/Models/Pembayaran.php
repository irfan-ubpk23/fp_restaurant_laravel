<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'order_id',
        'metode_pembayaran_id',
        'total_harga',
        'kode_transaksi',
        'status_pembayaran',
        'bukti_pembayaran'
    ];
}
