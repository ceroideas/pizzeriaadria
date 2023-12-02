<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddProductToFavoritesRequest;
use App\Http\Resources\V1\ProductResource;
use App\Http\Resources\V1\ProductSizeResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StoreCategory;


class ProductsControllers extends Controller
{
    public function index(Request $request) {

        $request->validate([ 'per_page' => 'integer' ]);

        $products = Product::paginate($request->per_page ?? 15)->withQueryString();
        return ProductResource::collection($products);
    }

    public function byCategory(Request $request) {

        $request->validate([ 'per_page' => 'integer', 'category' => 'integer|required' ]);

        $query = StoreCategory::where([ 'id' => $request->category ]);

        $per_page = $request->per_page ?? 15;
        return $query->count() ? ProductResource::collection($query->first()->products()->paginate($per_page)->withQueryString())
            : response()->json(['status' => 'error', 'message' => 'Category not found'], 404);


    }

    public function toggleFavorites(AddProductToFavoritesRequest $request) {
        $product = Product::where(['id' => $request->product_id ]);

        if($product->count()) {

            // Search for the poroduct in the favorites on the client
            $alreadyInFavorites = auth()->user()->client->favorites->first( function( Product $value, int $key) use ($request) {
                return $value['id'] == $request->product_id;
            });

            // Toggle Product In favorites
            if($alreadyInFavorites) {
                auth()->user()->client->favorites()->detach($product->first());
                return response()->json(['status' => 'success', 'message' => 'Producto eliminado correctamente', 'action' => 'remove'], 200);
            }else {
                auth()->user()->client->favorites()->attach($product->first());
                return response()->json(['status' => 'success', 'message' => 'Producto añadido a favoritos', 'action' => 'add'], 200);
            }


        }

        // Product Not found
        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
    }

    public function getFavorites(Request $request) {
        $request->validate([ 'per_page' => 'integer' ]);

        $products = auth('api')->user()->client->favorites()->paginate($request->per_page ?? 15);
        return ProductResource::collection($products);
    }
}
