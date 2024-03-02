<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|max:30|min:3|string',
            'email' => 'nullable|max:30|min:3|string|unique:customers,email',
            'phone' => 'required|regex:/^[0-9]+$/|max:15|unique:customers,phone',
            "image" => "nullable|max:10240|mimes:jpeg,png,jpg|image",
            'gender' => 'nullable',
            'member_ship_id' => 'nullable|string',
            'date_of_birth' => 'nullable',
            'due' => 'nullable|min:0',
            // 'customer_group_id' => 'nullable|numeric|exists:customer_groups,id',
            'date' => 'nullable',
            'area' => 'nullable|string',
            'country' => 'nullable|string',
            'zip_code' => 'nullable|numeric',
            'address' => 'nullable|string|min:3|max:50',
            'note' => 'nullable|string|min:3|max:200',
        ];
    }
}
