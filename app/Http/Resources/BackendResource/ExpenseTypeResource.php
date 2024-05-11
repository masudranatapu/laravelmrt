<?php

namespace App\Http\Resources\BackendResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseTypeResource extends JsonResource
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
            'expense_type_name' => $this->expense_type_name,
            'sorting_number' => $this->sorting_number,
            'status' => $this->status,
        ];
    }
}
