<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class StoreCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'parent_id ',
        'status '
    ];

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
