<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
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
            'type' => $this->type,
            'day' => $this->day,
            'hour' => $this->hour,
            'address' => $this->address,
            'total' => $this->total,
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
            'products' => OrderProductResource::collection($this->orderProducts)
        ];
    }
}
