<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'user_id',
        'meja_id',
        'nomor_antrian',
        'status_order',
        'jenis_order',
        'keterangan'
    ];

    public function details() : HasMany
    {
        return $this::HasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function user() : HasOne
    {
        return $this::HasOne(User::class, 'id', 'user_id');
    }

    public function meja() : HasOne
    {
        return $this::HasOne(Meja::class, 'id', 'meja_id');
    }
}
