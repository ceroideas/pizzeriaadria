<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlergenoResource;
use App\Models\Alergeno;
use Illuminate\Http\Request;

class AlergenosController extends Controller
{
    public function index(Request $request) {

        $request->validate([ 'per_page' => 'integer' ]);
        $per_page = $request->per_page ?? 15;

        return AlergenoResource::collection(Alergeno::paginate($per_page)->withQueryString());

    }
}
