<?php

namespace App\Http\Resources\AdminResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminBusinessResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'logo' => asset($this->logo),
            'favicon' => asset($this->favicon),
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'area' => $this->area,
            'city' => $this->city,
            'country' => $this->country,
            'phone' => $this->phone,
            'website' => $this->website,
            'currency' => $this->currency,
            'start_date' => $this->start_date,
            'validity_start' => $this->validity_start,
            'validity' => $this->validity,
            'status' => $this->status,
        ];
    }
}
