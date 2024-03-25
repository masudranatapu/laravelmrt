<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:30"],
            "designation" => ["required", "string", "max:30"],
            "review" => ["required", "string", "max:400"],
            "rating" => ["required", "numeric", "in:1,2,3,4,5"],
            "status" => ["nullable", "in:Active,Inactive"],
            "image" => ["required", "max:10240", "mimes:jpeg,png,jpg", "image"],
        ];
    }
}
