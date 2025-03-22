<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProductsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'number' => $this->number,
            'user_id' => $this->user_id,
            'phone' => $this->phone,
            'products' => OrderProductResource::collection($this->products()->get()),
            'status' => $this->status->name(),
            'subtotal' => (float) $this->subtotal,
            'offer' => (float) (float) $this->offer,
            'tax' => (float) $this->tax,
            'total' => (float) $this->total,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'resone_canceled' => $this->resone_canceled,
            'notes' => $this->notes,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
