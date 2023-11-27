<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;
use App\Models\Size;

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

    public function productExtraEngridients() {
        return $this->hasMany(IngredientOrderProduct::class);
    }
}
