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
        $formattedPrice = number_format($this->price, 2, '.', '');

        $response = [
            'id' => $this->id,
            'price' => $formattedPrice,
            'name' => $this->product->name,
            'ingredients' => IngredientOrderProductResource::collection($this->ingredients),
            'extraIngredients' => ExtraIngredientOrderProductResource::collection($this->extraIngredients)
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
