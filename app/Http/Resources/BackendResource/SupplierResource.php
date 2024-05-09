<?php

namespace App\Http\Resources\BackendResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
            "business_id" => $this->business_id,
            "business_name" => $this->business?->name,
            "supplier_business_name" => $this->supplier_business_name,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "image" => getImagePath($this->image),
            "area" => $this->area?->name,
            "area_id" => $this->area_id,
            "zip_code" => $this->zip_code,
            "address" => $this->address,
            "gender" => $this->gender,
            "date_of_birth" => $this->date_of_birth,
            "note" => $this->note,
            "paid_amount" => $this->paid_amount,
            "status" => $this->status,
            "date" => $this->date,
            "sorting_number" => $this->sorting_number,
            "due" => $this->supplierInitialDue?->amount,
        ];
    }
}
