<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'menu_id',
        'jumlah'
    ];

    public function menu() : HasOne
    {
        return $this->HasOne(Menu::class, 'id', 'menu_id');
    }
}
