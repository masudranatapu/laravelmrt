<?php

namespace App\Http\Resources\BackendResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'user' => 'demo resource admin',
            'type' => $this->expense_type_id,
            'account' => new AccountResource($this->account),
            'account_id' => $this->account_id,
            'pay_by' => $this->pay_by,
            'account_type' => $this->pay_by,
            'date' => $this->date,
            'amount' => $this->amount,
            'note' => $this->note,
        ];
    }
}
