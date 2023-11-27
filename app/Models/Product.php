<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoreCategory;
use App\Models\Ingredient;
use App\Models\Size;

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
}
