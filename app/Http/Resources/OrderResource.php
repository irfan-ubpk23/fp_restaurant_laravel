<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "nomor_antrian" => $this->nomor_antrian,
            "status_order" => $this->status_order,
            "jenis_order" => $this->jenis_order,
            "keterangan" => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            "user" => new UserResource($this->user),
            "details" => OrderDetailResource::collection($this->details)
        ];
    }
}
