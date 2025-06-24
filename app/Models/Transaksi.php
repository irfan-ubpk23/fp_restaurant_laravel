<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'user_id',
        'order_id',
        'metode_pembayaran',
        'total_harga',
        'kode_transaksi',
        'status_pembayaran',
        'bukti_pembayaran'
    ];

    public function user() : HasOne
    {
        return $this::HasOne(User::class, 'id', 'user_id');
    }

    public function order() :HasOne
    {
        return $this::HasOne(Order::class, "id", "order_id");
    }

    public function reservasi() : HasOne
    {
        return $this::HasOne(Reservasi::class, 'transaksi_id', 'id');
    }

}
