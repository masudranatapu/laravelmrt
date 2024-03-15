<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            "title" => ["required", "string", "min:3", "max:40"],
            "monthly_service_charge" => ["required", "integer", "min:1"],
            "installment_fee" => ["required", "integer", "min:1"],
            "branch_limit" => ["required", "integer", "min:1"],
            "user_limit" => ["required", "integer", "min:1"],
            "product_limit" => ["required", "integer", "min:1"],
            "description" => ["required", "string", "min:2", "max:1000"],
            "setting_access" => ["required", "array"],
        ];
    }
}
