<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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





        switch ($this->method()) {
            case 'POST': {
                    return [
                        'phone' => 'required|numeric',
                        'address' => 'required|string',
                        'latitude' => 'required|string|max:255',
                        'longitude' => 'required|string|max:255',
                        'notes' => 'nullable|string|max:255',
                        // 'products' => 'required|array',
                        // 'products.*.id' => "required|exists:products,id",
                        // 'products.*.qty' => "required|exists:products,id",
                    ];
                }
                // case 'PUT':
            case 'PATCH': {
                    return [
                        'resone_canceled' => 'required|string'
                    ];
                }
            default:
                break;
        }
    }
}
