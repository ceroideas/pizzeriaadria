<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Alergeno extends Model
{
    use HasFactory;

    public function getImageUrlAttribute() {
        return asset("storage/{$this->image}");
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
