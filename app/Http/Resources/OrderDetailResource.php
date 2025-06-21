<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "order_id" => $this->order_id,
            "menu_id" => $this->menu_id,
            "jumlah" => $this->jumlah,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            "menu" => new MenuResource($this->menu)
        ];
    }
}
