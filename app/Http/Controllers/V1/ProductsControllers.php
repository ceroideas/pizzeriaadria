<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductsControllers extends Controller
{
    public function index(Request $request) {

        $request->validate([ 'per_page' => 'integer' ]);

        $products = Product::paginate($request->per_page ?? 15)->withQueryString();
        return ProductResource::collection($products);
    }
}
