<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'nama_kategori'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id', 'id_kategori');
    }
}
