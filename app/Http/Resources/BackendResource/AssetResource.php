<?php

namespace App\Http\Resources\BackendResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            'asset_category_name' => $this->asset_category_id,
            'account_name' => $this->account_id,
            'pay_by' => $this->pay_by,
            'date' => $this->date,
            'amount' => $this->amount,
            'note' => $this->note,
            "sorting_number" => $this->sorting_number,
        ];
    }
}
