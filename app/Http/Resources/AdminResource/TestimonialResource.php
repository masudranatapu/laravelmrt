<?php

namespace App\Http\Resources\AdminResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'designation' => $this->designation,
            'image' => asset($this->image),
            'review' => $this->review,
            'rating' => $this->rating,
            'status' => $this->status,
            'create_by' => $this->createBy?->name,
        ];
    }
}
