<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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

            'title' => 'required|string|min:3|max:255',
            'release_year' => 'required|integer|min:1888|max:' . (date('Y') + 1),
            'type' => 'required|in:action,comedy,drama,horror',
            'rating' => 'numeric|required|max:10|min:0',
            'description' => 'required|string|min:5|max:1000000',
            "poster" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
