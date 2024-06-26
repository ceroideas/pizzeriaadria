<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;
use App\Models\Size;
use App\Models\ProductSize;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_product';
    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'price',
        'quantity'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function size() {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function productSize() {
        return $this->hasOne(ProductSize::class, 'id', 'size_id');
    }

    public function extraIngredients() {
        return $this->belongsToMany(Ingredient::class, 'order_product_extra_ingredients');
    }

    public function ingredients() {
        return $this->hasMany(IngredientOrderProduct::class);
    }
}
