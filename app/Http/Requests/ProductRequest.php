<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => 'required|string|max:255|unique:products,name',
                        'category_id' => 'required|exists:categories,id',
                        'main_image' => "required|image|mimes:jpeg,png,jpg,gif",
                        // 'images' => "nullable|array|mimes:jpeg,png,jpg,gif",
                        'images' => 'nullable|array',
                        'images.*' => 'mimes:jpeg,png,jpg,gif',
                        'description' => 'required|string',
                        'price' => 'required|numeric',
                        'price_offer' => 'nullable|numeric',
                        'status' => 'required|boolean',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|string|max:255|unique:products,name,' . $this->product,
                        'category_id' => 'required|exists:categories,id',
                        'main_image' => "nullable|image|mimes:jpeg,png,jpg,gif",
                        'images' => "nullable|image|mimes:jpeg,png,jpg,gif",
                        'description' => 'required|string',
                        'price' => 'required|numeric',
                        'price_offer' => 'nullable|numeric',
                        'status' => 'required|boolean',
                    ];
                }
            default:
                break;
        }
    }
}
