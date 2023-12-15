<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Seed de ingredientes
        $ingredients = [
            [
                'name' => 'Queso Mozarella',
                'slug' => 'queso-mozarella',
                'extra_price' => 2.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Pepperoni',
                'slug' => 'pepperoni',
                'extra_price' => 3.00,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Pollo a la Barbacoa',
                'slug' => 'pollo-barbacoa',
                'extra_price' => 4.00,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Champiñones',
                'slug' => 'champinones',
                'extra_price' => 1.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Aceitunas Negras',
                'slug' => 'aceitunas-negras',
                'extra_price' => 2.00,
                'image' => null,
                'status' => true,
            ],
            // Agrega más ingredientes según sea necesario
           [
                'name' => 'Tomate Fresco',
                'slug' => 'tomate-fresco',
                'extra_price' => 1.00,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Albahaca Fresca',
                'slug' => 'albahaca-fresca',
                'extra_price' => 1.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Jamón',
                'slug' => 'jamon',
                'extra_price' => 2.00,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Piña',
                'slug' => 'pina',
                'extra_price' => 1.75,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Tomate Seco',
                'slug' => 'tomate-seco',
                'extra_price' => 2.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Cebolla Roja',
                'slug' => 'cebolla-roja',
                'extra_price' => 1.25,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Ajo Fresco',
                'slug' => 'ajo-fresco',
                'extra_price' => 1.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Tofu',
                'slug' => 'tofu',
                'extra_price' => 3.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Bacon',
                'slug' => 'bacon',
                'extra_price' => 2.75,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Anchoas',
                'slug' => 'anchoas',
                'extra_price' => 3.25,
                'image' => null,
                'status' => true,
            ],

            [
                'name' => 'Hielo',
                'slug' => 'hielo',
                'extra_price' => 0.50,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Rodaja de Limón',
                'slug' => 'rodaja-limon',
                'extra_price' => 0.75,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Menta Fresca',
                'slug' => 'menta-fresca',
                'extra_price' => 1.00,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Jarabe de Vainilla',
                'slug' => 'jarabe-vainilla',
                'extra_price' => 1.25,
                'image' => null,
                'status' => true,
            ],
            [
                'name' => 'Canela en Rama',
                'slug' => 'canela-rama',
                'extra_price' => 1.50,
                'image' => null,
                'status' => true,
            ]
        ];

        foreach ($ingredients as $ingredientData) {
            \App\Models\Ingredient::create($ingredientData);
        }
    }
}
