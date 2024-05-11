<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id ? $this->id : '';
        return [
            "date" => ["required", "date"],
            "type" => ['required','array','min:1'],
            "type.*id" => ['required','integer','exists:expense_types,id'],
            "account_type" => [
                'required',
                'string',
                'in:Cash,Mobile Banking',
            ],
            "account_id" => ["required", "exists:accounts,id"],
            "amount" => ["required", "integer", "min:1"],
            "note" => ["nullable", "string", "min:3", "max:200"],
        ];
    }
}
