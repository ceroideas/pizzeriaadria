<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\V1\StoreCategoryResource;
use App\Http\Controllers\Controller;
use App\Models\StoreCategory;
use Illuminate\Http\Request;


class StoreCategoryController extends Controller
{
    public function index(Request $request) {

        $request->validate([ 'per_page' => 'integer' ]);

        $categories = StoreCategory::paginate($request->per_page ?? 15)->withQueryString();
        return StoreCategoryResource::collection($categories);
    }
}
