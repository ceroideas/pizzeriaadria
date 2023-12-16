<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\AlergenoResource;
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
            'price' => floatval($formattedPrice),
            'quantity' => $this->quantity,
            'img' => $this->product->image_url,
            'name' => $this->product->name,
            'ingredients' => IngredientOrderProductResource::collection($this->ingredients),
            'extraIngredients' => ExtraIngredientOrderProductResource::collection($this->extraIngredients),
            'alergenos' => AlergenoResource::collection( $this->product->alergenos )
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
