<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'image' => $this->image?->path ? display_file($this->image->path) : null,
            'email' => $this->email,
            'rate' => $this->pivot->rate,
            'notes' => $this->pivot->notes,
            'created_at' => $this->pivot->created_at->diffForHumans()
        ];
    }
}
