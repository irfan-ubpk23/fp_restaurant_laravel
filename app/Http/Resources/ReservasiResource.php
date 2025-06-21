<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservasiResource extends JsonResource
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
            'user_id' => $this->user_id,
            'meja_id' => $this->meja_id,
            'transaksi_id' => $this->transaksi_id,
            'tanggal_dan_jam' => $this->tanggal_dan_jam,
            'status_reservasi' => $this->status_reservasi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
