<?php

namespace App\Http\Requests\FrontedRequest;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|min:2|max:20',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]+$/|max:15',
            'subject' => 'required|min:3|max:50',
            'message' => 'required|min:3|max:200',
        ];
    }
}
