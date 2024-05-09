<?php

namespace App\Http\Resources\AdminResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            "title" => $this->title,
            "admin" => $this->admin?->name,
            "price" => $this->price,
            "monthly_service_charge" => $this->monthly_service_charge,
            "installment_fee" => $this->installment_fee,
            "branch_limit" => $this->branch_limit,
            "user_limit" => $this->user_limit,
            "product_limit" => $this->product_limit,
            "customer_limit" => $this->customer_limit,
            "supplier_limit" => $this->supplier_limit,
            "description" => $this->description,
        ];
    }
}
