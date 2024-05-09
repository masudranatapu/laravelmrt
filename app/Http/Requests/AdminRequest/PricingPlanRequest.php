<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PricingPlanRequest extends FormRequest
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
            "month" => ["required", "integer", "min:1"],
            "discount_type" => [
                "required",
                Rule::in(['Percentage', 'Amount'])
            ],
            "discount_value" => [
                "required",
                "integer",
                "min:0",
                function ($attribute, $value, $fail) {
                    $discountType = request('discount_type');
                    if ($discountType === 'Percentage' && $value >= 100) {
                        $fail("The discount value must be less than 100 when the discount type is Percentage.");
                    }
                },
            ],
        ];
    }
}
