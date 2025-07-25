<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MejaResource extends JsonResource
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
            "nama_meja" => $this->nama_meja,
            'batas_orang' => $this->batas_orang,
            'status_meja' => $this->status_meja,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
