<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "uid" => $this->uid,
            "member_ship_id" => $this->member_ship_id,
            "business_id" => $this->business?->name,
            "customer_group_name" => $this->customerGroup?->name,
            "customer_group_id" => $this->customer_group_id,
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
            "balance" => $this->balance,
            "paid_amount" => $this->paid_amount,
            "status" => $this->status,
            "date" => $this->date,
            "due" => $this->customerInitialDue?->amount,
        ];
    }
}
