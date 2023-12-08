<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddProductRequest;
use App\Http\Requests\V1\DeleteProductRequest;
use App\Http\Resources\V1\OrderResource;
use App\Http\Requests\V1\ChangeOrderStatusRequest;
use App\Models\Product;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Ingredient;

class OrdersController extends Controller
{
    public function index() {

        $orders = auth()->user()->client->orders;
        return OrderResource::collection($orders);
    }

    public function changeOrderStatus(ChangeOrderStatusRequest $request) {
        $order = auth()->user()->client->orders()->where(['status' => '0']);
        if ($order->count()) {

            $order = $order->first();
            $order->update(['status' => $request->status]);
            return response()->json(['status' => 'success', 'message' => 'Estatus de la ordend actualizado correctamente'], 200);

        }
        // No current order
        return response()->json(['status' => 'error', 'message' => 'No tienes nada en tu carrito'], 404);
    }

    public function currentOrder() {
        $order = auth()->user()->client->orders()->where(['status' => '0']);
        if ($order->count()) {
            return new OrderResource($order->first());
        }

        // No current order
        return response()->json(['status' => 'error', 'message' => 'No tienes nada en tu carrito'], 404);
    }

    public function deleteProduct(DeleteProductRequest $request) {
        $order = auth()->user()->client->orders()->where(['status' => '0']);
        if ($order->count()) {

            $order = $order->first();
            $orderProduct = $order->orderProducts()->where(['id' => $request->order_product_id])->first();
            if (!$orderProduct) {
                return response()->json(['status' => 'error', 'message' => 'Producto no encontrado en la orden'], 404);
            }

            $orderProduct->delete();
            return response()->json(['status' => 'success', 'message' => 'Producto eliminado del carrito con exito'], 200);
        }

        // No current order
        return response()->json(['status' => 'error', 'message' => 'No tienes un carrito de compras'], 404);
    }

    public function addproduct(AddProductRequest $request) {

        $product = Product::where(['id' => $request->product_id ]);

        if($product->count()) {

            $orders = auth()->user()->client->orders()->where(['status' => '0']);
            $order = $orders->count() ? $orders->first() : auth()->user()->client->orders()->create(['status' => '0']);

            $product = $product->first();
            $productSize = $product->sizes()->where(['id' => $request->product_size])->first();

            // Size not found
            if ($productSize == null && $request->product_size != null ) {
                return response()->json(['status' => 'error', 'message' => 'Tamaño del producto no encontrado'], 404);
            }

            $orderProductData = [
                'product_id' => $product->id,
                'size_id' => $request->product_size == null ? null : $productSize->id,
                'price' => $product->price
            ];

            $orderProduct = $order->orderProducts()->create($orderProductData);

            // Ingredients
            $productIngredients = $request->no_ingredients != null ? $product->ingredients()->whereNotIn('id', $request->no_ingredients)->get() : $product->ingredients;

            $ingredients = $productIngredients->map( function($ingredient) use ($orderProduct){
                return [
                    'order_product_id' => $orderProduct->id,
                    'ingredient_id' => $ingredient->id,
                    'extra_price' => $ingredient->extra_price
                ];
            });

            $ingredients->each( function($ingredient) use ($orderProduct) {
                $orderProduct->ingredients()->create($ingredient);
            });

            // Extra Ingredients
            $extraIngredients = $request->extra_ingredients != null ?  $extraIngredients = $product->extraIngredients()->whereIn('id', $request->extra_ingredients)->get() : collect([]);

            $extraIngredients->each( function($extraIngredient) use ($orderProduct){
                $orderProduct->extraIngredients()->attach($extraIngredient);
            });

            return response()->json(['status' => 'success', 'message' => 'Producto añadido correctamente'], 200);
        }

        // Product Not found
        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
    }
}
