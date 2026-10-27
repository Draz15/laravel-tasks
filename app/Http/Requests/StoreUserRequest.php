<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "name" => 'required|max:30|min:3|string',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:6|max:30',
            "role" => 'in:0,1',
            "image" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
