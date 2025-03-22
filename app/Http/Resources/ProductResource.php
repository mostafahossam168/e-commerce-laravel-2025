<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'price_offer' => $this->price_offer,
            'description' => $this->description,
            'status' => $this->status,
            'main_image' => $this->main_image,
            'images' => ImageResource::collection($this->images()->get()),
        ];
    }
}
