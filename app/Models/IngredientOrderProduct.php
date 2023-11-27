<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduct;
use App\Models\Ingredient;

class IngredientOrderProduct extends Model
{
    use HasFactory;
    protected $table = 'ingredient_order_product';
    protected $fillable = [
        'order_product_id',
        'ingredient_id',
        'extra_price'
    ];

    public function orderProduct() {
        return $this->belongsTo(OrderProduct::class);
    }

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }
}
