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
        StoreCategory::factory(5)->create()->each(function ($category) {
            $category->products()->saveMany( Product::factory(30)->create() );
        });
    }
}
