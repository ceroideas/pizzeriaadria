<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Alergeno;

class ProductRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        // Obtener todos los ingredientes, ingredientes extras y alérgenos
        $allIngredients = Ingredient::all();
        $allExtraIngredients = Ingredient::all();
        $allAlergenos = Alergeno::all();

        // Iterar sobre cada producto y asociar ingredientes, ingredientes extras y alérgenos aleatorios
        foreach ($products as $product) {
            // Asociar 5 ingredientes aleatorios
            $randomIngredients = $allIngredients->random(5);
            $product->ingredients()->sync($randomIngredients->pluck('id'));

            // Asociar 5 ingredientes extras aleatorios
            $randomExtraIngredients = $allExtraIngredients->random(5);
            $product->extraIngredients()->sync($randomExtraIngredients->pluck('id'));

            // Asociar 5 alérgenos aleatorios
            $randomAlergenos = $allAlergenos->random(5);
            $product->alergenos()->sync($randomAlergenos->pluck('id'));       //
        }
    }
}
