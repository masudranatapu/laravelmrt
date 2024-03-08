<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessTypeResource extends JsonResource
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
            "business_type_name" => $this->business_type_name,
            "access" => json_decode($this->access, true),
            "status" => $this->status,
            "created_by" => $this->admin?->name,
        ];
    }
}
