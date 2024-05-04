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
        $id = $this->id ? $this->id : '';
        return [
            'name' => ['required', 'min:3',  'max:30', 'string'],
            'phone' => ['required', 'regex:/^[0-9]+$/', 'max:15'],
            'start_date' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('businesses', 'email')->ignore($id),
            ],
            'city' => ['nullable', 'string'],
            'zip_code' => ['nullable', 'nullable', 'integer'],
            'address' => ['required', 'string', 'max:50'],
            'user_name' => ['required', 'min:3', 'max:50', 'string'],
            'user_email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->where(function ($query) use ($id) {
                    return $query->where('business_id', $id);
                })
            ],
            'password' => ['required', 'string', 'min:3', 'max:20'],
            'business_type_id' => [
                'required',
                'integer',
                Rule::exists('business_types', 'id')
            ],
            'pricing_plan_id' => [
                'required',
                'integer',
                Rule::exists('pricing_plans', 'id')
            ],
            'package_id' => [
                'required',
                'integer',
                Rule::exists('packages', 'id')
            ],
            'service_charge' => ['required', 'numeric'],
            'total_month' => ['required', 'numeric'],
            'fees' => ['required', 'numeric'],
            'branch_limit' => ['required', 'integer'],
            'user_limit' => ['required', 'integer'],
            'product_limit' => ['required', 'integer'],
            'option_access' => ['required', 'array', 'min:1'],
            'logo' => ['nullable', 'max:10240', 'mimes:jpeg,png,jpg,webp', 'image'],
            'favicon' => ['nullable', 'max:10240', 'mimes:jpeg,png,jpg,webp', 'image'],
            // 'status' => ['nullable', Rule::in(['Active', 'Inactive', 'Pending', 'Blocked'])],
        ];
    }
}
