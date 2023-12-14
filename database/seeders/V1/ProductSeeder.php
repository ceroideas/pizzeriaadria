<?php

namespace Database\Seeders\V1;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $pizzas = [
            [
                'name' => 'Pizza Margarita',
                'description' => 'Tomate, mozzarella, albahaca',
                'slug' => 'pizza-margarita',
                'featured' => true,
                'recommended' => false,
                'price' => 12.99,
                'category_id' => 1, // Reemplaza con la categoría correcta
                'status' => true,
                'url' => 'https://imag.bonviveur.com/pizza-margarita.webp'
            ],

            [
                'name' => 'Pizza Pepperoni',
                'description' => 'Tomate, mozzarella, pepperoni',
                'slug' => 'pizza-pepperoni',
                'featured' => false,
                'recommended' => true,
                'price' => 14.99,
                'category_id' => 1, // Reemplaza con la categoría correcta
                'status' => true,
            ],

            [
                'name' => 'Pizza BBQ Chicken',
                'description' => 'Salsa barbacoa, pollo, cebolla',
                'slug' => 'pizza-bbq-chicken',
                'featured' => true,
                'recommended' => true,
                'price' => 16.99,
                'category_id' => 2, // Reemplaza con la categoría correcta
                'status' => true,
            ],

            [
                'name' => 'Pizza Vegetariana',
                'description' => 'Tomate, mozzarella, champiñones, pimientos, aceitunas',
                'slug' => 'pizza-vegetariana',
                'featured' => false,
                'recommended' => false,
                'price' => 13.99,
                'category_id' => 3, // Reemplaza con la categoría correcta
                'status' => true,
            ],

          // Pizza Hawaiana
            [
                'name' => 'Pizza Hawaiana',
                'description' => 'Tomate, mozzarella, jamón, piña',
                'slug' => 'pizza-hawaiana',
                'featured' => true,
                'recommended' => false,
                'price' => 15.99,
                'category_id' => 1, // Reemplaza con la categoría correcta
                'status' => true,
            ],

            // Pizza Mediterránea
            [
                'name' => 'Pizza Mediterránea',
                'description' => 'Tomate, mozzarella, aceitunas, tomates secos, albahaca',
                'slug' => 'pizza-mediterranea',
                'featured' => true,
                'recommended' => true,
                'price' => 17.99,
                'category_id' => 2, // Reemplaza con la categoría correcta
                'status' => true,
            ],

            // Pizza BBQ Vegana
            [
                'name' => 'Pizza BBQ Vegana',
                'description' => 'Salsa barbacoa, tofu, cebolla morada, pimientos',
                'slug' => 'pizza-bbq-vegana',
                'featured' => false,
                'recommended' => true,
                'price' => 16.99,
                'category_id' => 3,// Reemplaza con la categoría correcta
                'status' => true,
            ],

            // Pizza de Queso Cuatro
            [
                'name' => 'Pizza de Queso Cuatro',
                'description' => 'Mozzarella, queso cheddar, queso feta, queso parmesano',
                'slug' => 'pizza-queso-cuatro',
                'featured' => false,
                'recommended' => false,
                'price' => 18.99,
                'category_id' => 2, // Reemplaza con la categoría correcta
                'status' => true,
            ],

            // Pizza de Pollo y Champiñones
            [
                'name' => 'Pizza de Pollo y Champiñones',
                'description' => 'Tomate, mozzarella, pollo a la parrilla, champiñones',
                'slug' => 'pizza-pollo-champinones',
                'featured' => false,
                'recommended' => true,
                'price' => 19.99,
                'category_id' => 2, // Reemplaza con la categoría correcta
                'status' => true,
            ],
        ];

           foreach ($pizzas as &$pizzaData) {
            // Genera el nombre de archivo de la imagen basado en el nombre de la pizza
            $imageName = strtolower(str_replace(' ', '-', $pizzaData['name'])) . '.jpg';

            // Descarga la imagen desde una URL o utiliza la que ya tienes localmente
            // En este ejemplo, se asume que las imágenes se encuentran en la carpeta public/images/pizzas/
            $imageUrl = 'https://example.com/path-to-images/' . $imageName;
            $imagePath = 'images/pizzas/' . $imageName;

            // Descarga la imagen y guárdala en el almacenamiento local
            Storage::put($imagePath, file_get_contents($imageUrl));

            // Asigna el nombre de la imagen a la columna 'image' en los datos de la pizza
            $pizzaData['image'] = $imagePath;
        }


        foreach ($pizzas as $pizzaData) {
            Product::create($pizzaData);
        }
    }
}
