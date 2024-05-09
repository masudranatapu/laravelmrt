<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        return [
            "account_type" => [
                "required",
                "string",
                Rule::in(['Cash', 'Mobile Banking', 'Card', 'Bank Account', 'Other'])
            ],
            "mobile_bank_name" => [
                "required_if:account_type,Mobile Banking",
                "string",
                Rule::in(['Rocket', 'Nagad', 'Upay', 'MCash', 'SureCash', 'Tap', 'bKash'])
            ],
            "mobile_number" => ["required_if:account_type,Mobile Banking", "max:15"],
            "pm_charge" => ["required_if:account_type,Mobile Banking",],
        ];
    }
}
