<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_kategori' => $this->id_kategori,
            'nama_menu' => $this->nama_menu,
            'harga_menu' => $this->harga_menu,
            'status_menu' => $this->status_menu,
            'waktu_saji' => $this->waktu_saji,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
