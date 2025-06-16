<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'id_kategori',
        'nama_menu',
        'gambar_menu',
        'harga_menu',
        'status_menu',
        'waktu_saji'
    ];

    public function kategori() : HasOne
    {
        return $this->hasOne(Kategori::class, 'id', 'id_kategori');
    }
}
