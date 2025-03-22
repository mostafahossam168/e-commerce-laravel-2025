<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'website_name' => 'nullable',
            'website_url' => 'nullable',
            'tax_number' => 'nullable',
            'address' => 'nullable',
            'building_number' => 'nullable',
            'street_number' => 'nullable',
            'phone' => 'nullable',
            'iban' => 'nullable',
            'is_tax' => 'nullable',
            'is_can_send_email' => 'nullable',
            'website_status' => 'nullable',
            'logo' => 'nullable',
            'fav' => 'nullable',
            'maintainance_message' => 'nullable',
            'whatsapp' => 'nullable',
            'snapchat' => 'nullable',
            'twitter' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'email' => 'nullable',
            'active_client' => 'nullable',
            'tax' => 'nullable',
            'commission' => 'nullable',
            'currency' => 'nullable',
        ];
    }
}
