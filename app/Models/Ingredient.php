<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'extra_price',
        'image',
        'status',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
