<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "username" => $this->username,
            "email" => $this->email,
            "no_hp" => $this->no_hp,
            "role" => $this->role,

            'activity_logs' => $this->activity_logs,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
