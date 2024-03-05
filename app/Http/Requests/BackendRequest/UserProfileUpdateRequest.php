<?php

namespace App\Http\Requests\BackendRequest;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
            "name" => ["required", "regex:/^[a-zA-Z]+$/"],
            "username" => ["required", "string", "min:3", "max:20"],
            "email" => ["required", "email", "max:30"],
            "phone" => ["required", " regex:/^[0-9]+$/", "max:15"],
            "address" => ["required", "string", "min:3", "max:50"],
            "gender" => ["required", "in:Male,Female"],
            "country" => ["required", "string"],
            "bio" => ["required", "string", "min:3", "max:200"],
        ];
    }
}
