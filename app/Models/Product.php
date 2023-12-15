<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoreCategory;
use App\Models\Ingredient;
use App\Models\OrderProduct;
use App\Models\Client;
use App\Models\ProductSize;
use App\Models\Alergeno;
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
        return $this->hasMany(ProductSize::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }

    public function extraIngredients() {
        return $this->belongsToMany(Ingredient::class, 'extra_ingredients');
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function getImageUrlAttribute() {
        return asset("storage/{$this->image}");
    }

    public function favorites() {
        return $this->belongsToMany(Client::class, 'favorites');
    }

    public function alergenos() {
        return $this->belongsToMany(Alergeno::class);
    }
}
