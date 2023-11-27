<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\OrderProduct;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'size_id');
    }
}
