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
            'order_id' => $this->order_id,
            'metode_pembayaran_id' => $this->metode_pembayaran_id,
            'total_harga' => $this->total_harga,
            'kode_transaksi' => $this->kode_transaksi,
            'status_pembayaran' => $this->status_pembayaran,
            'order' => new OrderResource($this->order),
            'metode_pembayaran' => $this->metode_pembayaran,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
