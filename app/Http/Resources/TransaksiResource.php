<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
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
            'user.username' => $this->user->username,
            'order_id' => $this->order_id,
            'total_harga' => $this->total_harga,
            'kode_transaksi' => $this->kode_transaksi,
            'bukti_pembayaran' => $this->bukti_pembayaran,
            'status_pembayaran' => $this->status_pembayaran,
            'metode_pembayaran' => $this->metode_pembayaran,
            
            'order' => new OrderResource($this->order),
            'reservasi' => new ReservasiResource($this->reservasi),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
