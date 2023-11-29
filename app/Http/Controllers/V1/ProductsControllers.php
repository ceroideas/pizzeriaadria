<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
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
}
