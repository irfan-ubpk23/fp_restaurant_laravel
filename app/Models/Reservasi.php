<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $fillable = [
        'user_id',
        'order_id',
        'meja_id',
        'transaksi_id',
        'tanggal_dan_jam',
        'status_reservasi'
    ];

    public function user() : HasOne
    {
        return $this::HasOne(User::class, 'id', 'user_id');
    }

    public function meja() : HasOne
    {
        return $this::HasOne(Meja::class, 'id', 'meja_id');
    }

    public function transaksi() : HasOne
    {
        return $this::HasOne(Transaksi::class, 'id', 'transaksi_id');
    }
}
