<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'order_id',
        'metode_pembayaran',
        'total_harga',
        'kode_transaksi',
        'status_pembayaran',
        'bukti_pembayaran'
    ];

    public function order() :HasOne
    {
        return $this::HasOne(Order::class, "id", "order_id");
    }

}
