<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $sizes = [
            ['name' => 'Pequeño'],
            ['name' => 'Mediano'],
            ['name' => 'Grande']
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
