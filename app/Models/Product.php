<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoreCategory;
use App\Models\Ingredient;
use App\Models\OrderProduct;
use App\Models\Size;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'featured',
        'recommended',
        'price',
        'category_id',
        'size_id',
        'status',
    ];

    public function category() {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }

    public function sizes() {
        return $this->belongsToMany(Size::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }

    public function images() {
        return $this->belongsToMany(Image::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }
}
