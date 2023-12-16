<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StoreCategory;
use App\Models\Product;

class StoreCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ['name' => 'Pizzas', 'slug' => 'pizzas', 'status' => true],
            ['name' => 'Bebidas', 'slug' => 'bebidas', 'status' => true],
            ['name' => 'Postres', 'slug' => 'postres', 'status' => true],
        ];

        foreach ($categories as $category) {
            StoreCategory::create($category);
        }

        $products = Product::all();

        foreach ($products as $product) {
            $randomCategory = StoreCategory::inRandomOrder()->first();
            $product->category()->associate($randomCategory)->save();
        }
    }
}
