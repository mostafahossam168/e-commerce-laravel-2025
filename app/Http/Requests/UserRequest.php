<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [

    //     ];
    // }



    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required',
                        'phone' => 'required|numeric|unique:users,phone',
                        'email' => 'required|email|unique:users,email',
                        'image' => 'nullable|mimes:png,jpg',
                        'password' => 'required|min:4|confirmed',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'phone' => 'required|numeric|unique:users,phone',
                        'email' => 'required|email|unique:users,email',
                        'image' => 'nullable|mimes:png,jpg'
                        // 'phone' => 'required|numeric|unique:clients,phone,' . $this->route()->client->id,
                    ];
                }
            default:
                break;
        }
    }
}