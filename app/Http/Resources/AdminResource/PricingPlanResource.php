<?php

namespace App\Http\Resources\AdminResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingPlanResource extends JsonResource
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
            'month' => $this->month,
            'discount_type' => $this->discount_type,
            'discount_value' => round($this->discount_value, 2),
            'admin_id' => $this->admin_id,
            'created_by' => $this->admin?->name,
        ];
    }
}
