<?php

namespace App\Http\Resources\V1;

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
        $user = auth('api')->user()->id ?? null;
        $inFavorites = false;

        if ($user) {

            $found = auth('api')->user()->client->favorites->first(function($product, $key){
                return $product->id == $this->id;
            });

            $inFavorites = $found != null ? true : false;

        }

        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'featured' => $this->featured ? true : false,
            'recommended' => $this->recommended ? true : false,
            'favorite' => $inFavorites,
            'price' => $this->price,
            'status' => $this->status ? true : false,
            'img' => $this->image ? $this->image_url : null
        ];

        $response['category'] = new StoreCategoryResource($this->category);

        $response['sizes'] = ProductSizeResource::collection($this->sizes);

        $response['ingredients'] = IngredientResource::collection($this->ingredients);

        $response['extra_available'] = IngredientResource::collection($this->extraIngredients);

        return $response;
    }
}
