<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'image' => 'nullable|mimes:png,jpg',
            'password' => "nullable|min:4|confirmed|max:255",
        ];
    }
}
