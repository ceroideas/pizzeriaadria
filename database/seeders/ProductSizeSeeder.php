<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Size;


class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Obtener todos los productos y tamaños
        $products = Product::all();
        $sizes = Size::all();

        // Iterar sobre cada producto y asociar tamaños con precios proporcionales
        foreach ($products as $product) {
            // Asociar tamaños con precios proporcionales
            $this->attachSize($product, $sizes->get(0), 0.15); // Tamaño Pequeño (+15%)
            $this->attachSize($product, $sizes->get(1), 0.30); // Tamaño Mediano (+30%)
            $this->attachSize($product, $sizes->get(2), 0.50); // Tamaño Grande (+50%)
        }
    }

    private function attachSize(Product $product, Size $size, float $percentage)
    {
        $price = $product->price * (1 + $percentage);

        $product->sizes()->create([
            'size_id' => $size->id,
            'price' => $price,
            'status' => true,
        ]);
    }
}
