<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            "name" => ["required", "max:30", "min:3", "string"],
            "phone" => ["required", "regex:/^[0-9]+$/", "max:15"],
            "supplier_business_name" => ["nullable", "string", "min:3", "max:30"],
            "email" => ["nullable", "min:3", "max:30", "string"],
            "image" => ["nullable", "max:10240", "mimes:jpeg,png,jpg,webp", "image"],
            "gender" => ["nullable"],
            "date_of_birth" => ["nullable"],
            "due" => ["nullable", "min:0"],
            "date" => "nullable",
            "area" => ["nullable", "string", "exists:areas,id"],
            "zip_code" => ["nullable", "numeric"],
            "address" => ["nullable", "string", "min:3", "max:50"],
            "sorting_number" => ["nullable", "string", "min:1", "max:11"],
            "note" => ["nullable", "string", "min:3", "max:200"],
        ];
    }
}
