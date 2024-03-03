<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class CustomerGroupRequest extends FormRequest
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
        if ($this->_method == 'POST') {
            return [
                'name' => ['required', 'string'],
                'amount' => ['required', 'numeric', 'min:1'],
            ];
        } else {
            return [
                'name' => ['required', 'string'],
                'amount' => ['required', 'numeric', 'min:1'],
            ];
        }
    }
}
