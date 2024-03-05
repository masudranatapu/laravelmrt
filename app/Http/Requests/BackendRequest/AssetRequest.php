<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
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
            "asset_category_id" => ["required", "numeric", "exists:asset_categories,id"],
            "account_id" => ["required", "numeric", "exists:accounts,id"],
            "pay_by" => ["required"],
            "date" => ["required"],
            "amount" => ["required", "min:0"],
        ];
    }
}
