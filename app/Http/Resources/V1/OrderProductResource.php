<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'id' => $this->id,
            'price' => $this->price,
            'name' => $this->product->name,
            'ingredients' => IngredientOrderProductResource::collection($this->productExtraEngridients)
        ];

        if($this->productSize) {
            $response['size'] = [
                'name' => $this->productSize->size->name,
                'price' => $this->productSize->price
            ];
        }else {
            $response['size'] = null;
        }



        return $response;
    }
}
