<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessRequest extends FormRequest
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
            "business_id" => ["nullable"],
            "package_id" => ["nullable"],
            "pricing_plan_id" => ["nullable"],
            "business_type_id" => ["nullable"],
            "type" => ["required", Rule::in(['Owner', 'Branch'])],
            "name" => ["required", "max:30", "min:3", "string"],
            "logo" => ["nullable", "max:10240", "mimes:jpeg,png,jpg", "image"],
            "address" => ["nullable", "string", "min:3", "max:50"],
            "area" => ["nullable", "string"],
            "zip_code" => ["nullable", "numeric"],
            "country" => ["required"],
            "phone" => ["required", "regex:/^[0-9]+$/", "max:15"],
            "start_date" => ["required"],
            "validity_start" => ["required"],
            "validity" => ["required"],
            "business_access" => ["required"],
            "status" => ["required", Rule::in(['Active', 'Inactive', 'Pending', 'Blocked'])],
        ];
    }
}
