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

            [
                'name' => 'Pizza Pollo BBQ',
                'description' => 'Pollo a la barbacoa, cebolla, mozzarella',
                'slug' => 'pizza-pollo-bbq',
                'featured' => true,
                'recommended' => true,
                'price' => 14.99,
                'category_id' => 2,
                'status' => true,
            ],

            [
                'name' => 'Pizza Vegetariana Deluxe',
                'description' => 'Tomate, mozzarella, champiñones, espinacas, aceitunas',
                'slug' => 'pizza-vegetariana-deluxe',
                'featured' => false,
                'recommended' => true,
                'price' => 16.99,
                'category_id' => 3,
                'status' => true,
            ],

            [
                'name' => 'Pizza Hawaiana Especial',
                'description' => 'Tomate, mozzarella, jamón, piña, bacon',
                'slug' => 'pizza-hawaiana-especial',
                'featured' => true,
                'recommended' => false,
                'price' => 15.99,
                'category_id' => 1,
                'status' => true,
            ],

            [
                'name' => 'Pizza Carnívora',
                'description' => 'Tomate, mozzarella, pepperoni, salchicha, bacon',
                'slug' => 'pizza-carnivora',
                'featured' => false,
                'recommended' => true,
                'price' => 17.99,
                'category_id' => 1,
                'status' => true,
            ],

            [
                'name' => 'Pizza Mediterránea Especial',
                'description' => 'Tomate, mozzarella, aceitunas negras, tomates secos, albahaca, queso feta',
                'slug' => 'pizza-mediterranea-especial',
                'featured' => true,
                'recommended' => true,
                'price' => 19.99,
                'category_id' => 2,
                'status' => true,
            ],

            [
                'name' => 'Pizza de Pollo Buffalo',
                'description' => 'Pollo a la buffalo, mozzarella, cebolla morada, aderezo ranchero',
                'slug' => 'pizza-pollo-buffalo',
                'featured' => true,
                'recommended' => false,
                'price' => 16.99,
                'category_id' => 1,
                'status' => true,
            ],

            [
                'name' => 'Coca-Cola',
                'description' => 'Refresco de cola',
                'slug' => 'coca-cola',
                'featured' => true,
                'recommended' => true,
                'price' => 2.99,
                'category_id' => 4, // ID de la categoría de bebidas (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Limónada Fresca',
                'description' => 'Limón fresco exprimido, azúcar, agua',
                'slug' => 'limonada-fresca',
                'featured' => false,
                'recommended' => true,
                'price' => 3.99,
                'category_id' => 4, // ID de la categoría de bebidas (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Té Helado',
                'description' => 'Té negro con hielo y limón',
                'slug' => 'te-helado',
                'featured' => true,
                'recommended' => false,
                'price' => 2.49,
                'category_id' => 4, // ID de la categoría de bebidas (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Tiramisú',
                'description' => 'Postre italiano con capas de bizcocho, mascarpone y cacao',
                'slug' => 'tiramisu',
                'featured' => true,
                'recommended' => true,
                'price' => 5.99,
                'category_id' => 5, // ID de la categoría de postres (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Brownie con Helado',
                'description' => 'Brownie de chocolate con nueces, acompañado de helado de vainilla',
                'slug' => 'brownie-helado',
                'featured' => false,
                'recommended' => true,
                'price' => 6.99,
                'category_id' => 5, // ID de la categoría de postres (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Cheesecake de Fresa',
                'description' => 'Cheesecake con topping de salsa de fresa',
                'slug' => 'cheesecake-fresa',
                'featured' => true,
                'recommended' => false,
                'price' => 4.99,
                'category_id' => 5, // ID de la categoría de postres (ajusta según tu sistema)
                'status' => true,
            ],


            [
                'name' => 'Agua Mineral',
                'description' => 'Agua natural embotellada',
                'slug' => 'agua-mineral',
                'featured' => false,
                'recommended' => true,
                'price' => 1.99,
                'category_id' => 4, // ID de la categoría de bebidas (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Limonada con Menta',
                'description' => 'Limonada refrescante con hojas de menta',
                'slug' => 'limonada-menta',
                'featured' => true,
                'recommended' => false,
                'price' => 3.49,
                'category_id' => 4, // ID de la categoría de bebidas (ajusta según tu sistema)
                'status' => true,
            ],

            [
                'name' => 'Café Espresso',
                'description' => 'Café fuerte y concentrado',
                'slug' => 'cafe-espresso',
                'featured' => false,
                'recommended' => true,
                'price' => 2.49,
                'category_id' => 4, // ID de la categoría de bebidas (ajusta según tu sistema)
                'status' => true,
            ]
        ];

        foreach ($pizzas as $pizzaData) {
            Product::create($pizzaData);
        }
    }
}
