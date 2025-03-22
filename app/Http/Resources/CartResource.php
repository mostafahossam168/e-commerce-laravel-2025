<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product' => new ProductResource(Product::find($this->product_id)),
            // 'product_name' => $this->product?->name,
            // 'product_image' => display_file($this->product?->main_image),
            'price' => $this->price,
            'qty' => $this->qty,
            'subtotal' => $this->price *  $this->qty,
        ];
    }
}