<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function order() :HasOne
    {
        return $this::HasOne(Order::class, "id", "order_id");
    }

    public function metode_pembayaran() : HasOne
    {
        return $this::HasOne(MetodePembayaran::class, 'id', 'metode_pembayaran_id');
    }
}
